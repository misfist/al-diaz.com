jQuery(document).ready(function($) {
			/* initialize shuffle plugin */
			var $grid = $('#post-listing');

			$grid.shuffle({
				itemSelector: '.item' // the selector for the items in the grid
			});

			/* reshuffle when user clicks a filter item */
			$('#filter a').click(function (e) {
				e.preventDefault();

				// set active class
				$('#filter a').removeClass('active');
                                $('#filter a').removeClass('selected');
				$(this).addClass('active');
                                $(this).addClass('selected');

				// get group name from clicked item
				var groupName = $(this).attr('data-group');

				// reshuffle grid
				$grid.shuffle('shuffle', groupName );
			}); 
                        
                        $('select#get-cats').change(function (e){
                            e.preventDefault();
                            // get group name from clicked item
				var groupName = $(this).val();

				// reshuffle grid
				$grid.shuffle('shuffle', groupName );
                            
                        });

		});