<?php

/**
 * Addon class
 *
 * @since 1.0
 */
class CAC_Sortable_Model_User extends CAC_Sortable_Model {

	/**
	 * Constructor
	 *
	 * @since 1.0
	 */
	function __construct( $storage_model ) {
		parent::__construct( $storage_model );

		$this->default_orderby = '';

		add_action( 'pre_user_query', array( $this, 'handle_sorting_request' ), 2 ); // prio after filtering
		add_filter( "manage_users_sortable_columns", array( $this, 'add_sortable_headings' ) );
		add_action( 'restrict_manage_users', array( $this, 'add_reset_button' ) );
	}

	/**
	 * @see CAC_Sortable_Model::get_sortables()
	 * @since 1.0
	 */
	public function get_sortables() {

		$column_names = array(

			// WP default columns
			'role',
			'posts',

			// Custom Columns
			'column-first_name',
			'column-display_name',
			'column-last_name',
			'column-meta',
			'column-nickname',
			'column-roles',
			'column-user_commentcount',
			'column-user_description',
			'column-user_id',
			'column-user_postcount',
			'column-user_registered',
			'column-user_url',

			// ACF Fields
			'column-acf_field',

			// WooCommerce
			'column-wc-user-orders',
			'column-wc-user-order_count'
		);

		return $column_names;
	}

	/**
	 * Get Users
	 *
	 * Do not use get_users() method.
	 *
	 * @since 1.0
	 */
	private function get_user_ids() {
		global $wpdb;

		return $wpdb->get_col( "SELECT ID FROM $wpdb->users" );
	}

	/**
	 * @param $user_query
	 *
	 * @return array User IDS
	 */
	private function get_user_ids_by_query( $user_query ) {
		$_user_query = clone $user_query;
		$_user_query->set( 'fields', 'ids' ); // Less resources
		$_user_query->query_limit = null; // ALL users
		$_user_query->query();

		return (array) $_user_query->get_results();
	}

	/**
	 * Admin requests for orderby column
	 *
	 * Only works for WP_Query objects ( such as posts and media )
	 *
	 * @since 1.0
	 *
	 * @param array $vars
	 *
	 * @return array Vars
	 */
	public function handle_sorting_request( $user_query ) {
		global $wpdb;

		$vars = $user_query->query_vars;

		if ( empty( $vars['orderby'] ) ) {
			return;
		}

		$vars = $this->apply_sorting_preference( $vars );

		$column = $this->get_column_by_orderby( $vars['orderby'] );
		if ( empty( $column ) ) {
			return;
		}

		$_users = array();

		switch ( $column->properties->type ) :

			// WP Default Columns
			case 'role' :
			case 'column-roles' :
				global $wp_roles, $wpdb;
				$sort_flag = SORT_REGULAR;
				$prefix    = $wpdb->get_blog_prefix();
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					if ( $roles = get_user_meta( $id, $prefix . 'capabilities', true ) ) {
						$roles         = array_keys( $roles );
						$_users[ $id ] = $this->prepare_sort_string_value( translate_user_role( $wp_roles->roles[ $roles[0] ]['name'] ) );
					}

				}
				break;

			case 'posts' :
				$sort_flag = SORT_NUMERIC;
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					$value = $column->get_user_postcount( $id, 'post' );
					if ( $value || $this->show_all_results ) {
						$_users[ $id ] = $value;
					}
				}
				break;

			// Custom Columns
			case 'column-user_id' :
				$user_query->query_orderby = "ORDER BY ID {$vars['order']}";
				$vars['orderby']           = 'ID';
				break;

			case 'column-user_registered' :
				$user_query->query_orderby = "ORDER BY user_registered {$vars['order']}";
				$vars['orderby']           = 'registered';
				break;

			case 'column-nickname' :
				$sort_flag = SORT_REGULAR;
				break;

			case 'column-first_name' :
				$sort_flag = SORT_REGULAR;
				break;

			case 'column-display_name' :
				$sort_flag = SORT_REGULAR;
				break;

			case 'column-last_name' :
				$sort_flag = SORT_REGULAR;
				break;

			case 'column-user_url' :
				$sort_flag = SORT_REGULAR;
				break;

			case 'column-user_description' :
				$sort_flag = SORT_REGULAR;
				break;

			case 'column-user_commentcount' :
				// @todo: maybe use WP_Comment_Query to generate this subquery? penalty is extra query and bloat, advantage is WP_Comment_Query filters used
				$sub_query = "
					LEFT JOIN (
						SELECT user_id, COUNT(user_id) AS comment_count
						FROM {$wpdb->comments}
						WHERE user_id <> 0
						GROUP BY user_id
					) AS comments
					ON {$wpdb->users}.ID = comments.user_id
				";

				$user_query->query_from .= $sub_query;
				$user_query->query_orderby = "ORDER BY comment_count " . $vars['order'];

				if ( ! $this->show_all_results ) {
					$user_query->query_where .= " AND comment_count IS NOT NULL";
				}

				break;
			case 'column-user_postcount' :
				$sort_flag = SORT_NUMERIC;
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					$value = $column->get_count( $id );
					if ( $value || $this->show_all_results ) {
						$_users[ $id ] = $value;
					}
				}
				break;

			case 'column-meta' :

				$sort_flag = SORT_REGULAR;

				if ( 'numeric' == $column->options->field_type ) {
					$sort_flag = SORT_NUMERIC;
				}
				else if ( 'checkmark' == $column->options->field_type ) {
					$sort_flag = SORT_REGULAR;
					foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
						$value         = $column->get_value( $id );
						$_users[ $id ] = $value ? '1' : '0';
					}
				}
				else if ( in_array( $column->options->field_type, array( 'image', 'library_id' ) ) ) {
					$sort_flag = SORT_NUMERIC;
					foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
						$thumbs        = $column->get_thumbnails( $column->get_meta_by_id( $id ) );
						$_users[ $id ] = $thumbs ? count( $thumbs ) : 0;
					}
				}
				break;

			case 'column-acf_field' :
				if ( method_exists( $column, 'get_field' ) ) {
					$field     = $column->get_field();
					$sort_flag = in_array( $field['type'], array(
						'date_picker',
						'number'
					) ) ? SORT_NUMERIC : SORT_REGULAR;

					foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
						$value = $column->get_sorting_value( $id );
						if ( $value || $this->show_all_results ) {
							$_users[ $id ] = $this->prepare_sort_string_value( $value );
						}
					}
				}
				break;

			// WooCommerce
			case 'column-wc-user-orders':
				$sort_flag = SORT_NUMERIC;
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					$value = $column->get_raw_value( $id );
					if ( $value || $this->show_all_results ) {
						$_users[ $id ] = count( $value );
					}
				}
				break;
			case 'column-wc-user-order_count':
				$sort_flag = SORT_NUMERIC;
				break;


			case 'column-wc-user-total-sales':
				$sort_flag = SORT_NUMERIC;
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					$value = $column->get_sorting_value( $id );
					if ( $value || $this->show_all_results ) {
						$_users[ $id ] = $value;
					}
				}
				break;

			// Try to sort by raw value.
			default :
				$sort_flag = SORT_REGULAR;
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					$value = $column->get_raw_value( $id );
					if ( $value || $this->show_all_results ) {
						$_users[ $id ] = $value;
					}
				}

		endswitch;

		if ( isset( $sort_flag ) ) {

			if ( empty( $_users ) ) {

				// Use original user_query to retrieve user IDs. In case the user query has been filtered we'll
				// be sorting a lot less users
				foreach ( $this->get_user_ids_by_query( $user_query ) as $id ) {
					$value = $column->get_raw_value( $id );
					if ( $value || $this->show_all_results ) {
						$_users[ $id ] = $this->prepare_sort_string_value( $value );
					}
				}
			}

			// sorting
			if ( 'ASC' == $vars['order'] ) {
				asort( $_users, $sort_flag );
			} else {
				arsort( $_users, $sort_flag );
			}

			if ( ! empty( $_users ) ) {

				// for MU site compatibility
				$prefix = $wpdb->base_prefix;

				$column_names = implode( ',', array_keys( $_users ) );
				$user_query->query_where .= " AND {$prefix}users.ID IN ({$column_names})";
				$user_query->query_orderby = "ORDER BY FIELD({$prefix}users.ID,{$column_names})";
			}

			// cleanup
			$vars['order']   = '';
			$vars['orderby'] = '';
		}

		$user_query->query_vars = array_merge( $user_query->query_vars, $vars );
	}
}