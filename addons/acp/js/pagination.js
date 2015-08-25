// jPaginate Plugin for jQuery
// by Angel Grablev for Enavu Web Development network (enavu.com)
// Dual license under MIT and GPL :) enjoy
/*

To use simply call .paginate() on the element you wish like so:
$("#content").jPaginate(); 

you can specify the following options:
items = number of items to have per page on pagination
next = the text you want to have inside the text button
previous = the text you want in the previous button
active = the class you want the active paginaiton link to have
pagination_class = the class of the pagination element that is being generated for you to style
minimize = minimizing will limit the overall number of elements in the pagination links
nav_items = when minimize is set to true you can specify how many items to show
cookies = if you want to use cookies to remember which page the user is on, true by default

*/
(function($){
    $.fn.jPaginate = function(options) {
        var defaults = {
            items: 10,
            next: ">",
            previous: "<",
            active: "active",
            pagination_class: "pagination",
            minimize: false,
            nav_items: 10,
			cookies: false
        };
        var options = $.extend(defaults, options);

        return this.each(function() {
            // object is the selected pagination element list
            obj = $(this);
            // this is how you call the option passed in by plugin of items
            show_per_page = options.items;
            //getting the amount of elements inside parent element
            number_of_items = obj.children().size();
            //calculate the number of pages we are going to have
            number_of_pages = Math.ceil(number_of_items/show_per_page);
            //create the pages of the pagination
            array_of_elements = [];
            numP = 0;
            nexP = show_per_page;
            //loop through all pages and assign elements into array
            for (i=1;i<=number_of_pages;i++)
            {    
                array_of_elements[i] = obj.children().slice(numP, nexP);
                numP += show_per_page;
                nexP += show_per_page;
            }
            
            // display first page and set first cookie
			if (options.cookies == true) {
				if (get_cookie("current")) {
					showPage(get_cookie("current"));
					createPagination(get_cookie("current"));
				} else {
					set_cookie( "current", "1");
					showPage(get_cookie("current"));
					createPagination(get_cookie("current"));
				}
			} else {
                showPage(1);
				createPagination(1);
			}
            //show selected page
            function showPage(page) {
                if(number_of_pages===0) {
                    number_of_pages=1;
                    createPagination(1);
                    return;
                }
                obj.children().hide();
                array_of_elements[page].show('slow');
            }
            
            // create the navigation for the pagination 
            function createPagination(curr) {
                var start, items = "", end, nav = "";
                start = "<ul class='"+options.pagination_class+"'>";
                var previous = "<li><a class='goto_previous'>"+options.previous+"</a></li>";
                var next = "<li><a class='goto_next'>"+options.next+"</a></li>";
				var previous_inactive = "<li><a class='inactive'>"+options.previous+"</a></li>";
                var next_inactive = "<li><a class='inactive'>"+options.next+"</a></li>";
                end = "</ul>"
                var after = number_of_pages - options.after + 1;
                var pagi_range = paginationCalculator(curr);
				for (i=1;i<=number_of_pages;i++)
                {
                    if (options.minimize == true) {
						var half = Math.ceil(number_of_pages/2)
                    	if (i >= pagi_range.start && i <= pagi_range.end) {
							if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        	else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
						} else if (curr <= half) {
							if (i >= (number_of_pages - 2)) {
								if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        		else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
							} 
						} else if (curr >= half) {
							if (i <= 2) {
								if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        		else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
							}
						}
                    } else {
                        if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
                    }
                }
                if (curr != 1 && curr != number_of_pages) {
                    nav = start + previous + items + next + end;
                } else if (curr == 1 && curr == number_of_pages) {
                    nav = start + previous_inactive + items + next_inactive + end;
                } else if (curr == number_of_pages){
                    nav = start + previous + items + next_inactive + end;
                } else if (curr == 1) {
                    nav = start + previous_inactive + items + next + end;
                }
                obj.after(nav);
            }
			
			/* code to handle cookies */
			function set_cookie( name, value ) {		  
			  $.cookie(name, value);
			}
			function get_cookie ( cookie_name )	{
			 	return $.cookie(cookie_name);
			}
            
			function paginationCalculator(curr)  {
				var half = Math.floor(options.nav_items/2);
				var upper_limit = number_of_pages - options.nav_items;
				var start = curr > half ? Math.max( Math.min(curr - half, upper_limit), 0 ) : 0;
				var end = curr > half?Math.min(curr + half + (options.nav_items % 2), number_of_pages):Math.min(options.nav_items, number_of_pages);
				return {start:start, end:end};
			}
			
            // handle click on pagination
            if(window.pagination !== true){
                $(".goto").live("click", function(e){
                    e.preventDefault();
                    showPage($(this).attr("title"));
                    set_cookie( "current", $(this).attr("title"));
                    $(".pagination").remove();
                    createPagination($(this).attr("title"));
                });
                $(".goto_previous").live("click", function(e) {
                    e.preventDefault();
                    var act = "."+options.active;
                    var newcurr = parseInt($(".pagination").find(".active").attr("title")) - 1;
                    set_cookie( "current", newcurr);
                    showPage(newcurr);
                    $(".pagination").remove();
                    createPagination(newcurr);
                });
                $(".goto_next").live("click", function(e) {
                    e.preventDefault();
                    var act = "."+options.active;
                    var newcurr = parseInt($(".pagination").find(".active").attr("title")) + 1;
                    set_cookie( "current", newcurr);
                    showPage(newcurr);
                    $(".pagination").remove();
                    createPagination(newcurr);
                });
                window.pagination = true;
            }


        });
        
       
    };
	jQuery.cookie = function(name, value, options) {
		if (typeof value != 'undefined') { // name and value given, set cookie
			options = options || {};
			if (value === null) {
				value = '';
				options.expires = -1;
			}
			var expires = '';
			if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
				var date;
				if (typeof options.expires == 'number') {
					date = new Date();
					date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
				} else {
					date = options.expires;
				}
				expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
			}
			var path = options.path ? '; path=' + (options.path) : '';
			var domain = options.domain ? '; domain=' + (options.domain) : '';
			var secure = options.secure ? '; secure' : '';
			document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
		} else { // only name given, get cookie
			var cookieValue = null;
			if (document.cookie && document.cookie != '') {
				var cookies = document.cookie.split(';');
				for (var i = 0; i < cookies.length; i++) {
					var cookie = jQuery.trim(cookies[i]);
					// Does this cookie string begin with the name we want?
					if (cookie.substring(0, name.length + 1) == (name + '=')) {
						cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
						break;
					}
				}
			}
			return cookieValue;
		}
	};
})(jQuery);