/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.0
 * 
 * Theme Content Composer Schortcodes Extend
 * Created by CMSMasters
 * 
 */


/**
 * Blog Extend
 */
var cmsmasters_blog_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_blog.fields) {
	if (id === 'layout_mode') {
		cmsmastersShortcodes.cmsmasters_blog.fields[id]['choises']['puzzle'] = cmsmasters_theme_shortcodes.blog_field_layout_mode_puzzle;
		
		
		cmsmasters_blog_new_fields[id] = cmsmastersShortcodes.cmsmasters_blog.fields[id];
	} else if (id === 'filter_text') { 
		delete cmsmastersShortcodes.cmsmasters_blog.fields[id];
	} else {
		cmsmasters_blog_new_fields[id] = cmsmastersShortcodes.cmsmasters_blog.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_blog.fields = cmsmasters_blog_new_fields;



/**
 * Portfolio Extend
 */
cmsmastersShortcodes.cmsmasters_portfolio.title = cmsmasters_theme_shortcodes.portfolio_title;
cmsmastersShortcodes.cmsmasters_portfolio.fields.orderby.descr = cmsmasters_theme_shortcodes.portfolio_field_orderby_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.count.title = cmsmasters_theme_shortcodes.portfolio_field_pj_number_title;
cmsmastersShortcodes.cmsmasters_portfolio.fields.count.descr = cmsmasters_theme_shortcodes.portfolio_field_pj_number_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_theme_shortcodes.portfolio_field_pj_number_descr_note + "</span>";
cmsmastersShortcodes.cmsmasters_portfolio.fields.categories.descr = cmsmasters_theme_shortcodes.portfolio_field_categories_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_theme_shortcodes.portfolio_field_categories_descr_note + "</span>";
cmsmastersShortcodes.cmsmasters_portfolio.fields.layout.descr = cmsmasters_theme_shortcodes.portfolio_field_layout_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.layout['choises']['grid'] = cmsmasters_theme_shortcodes.portfolio_field_layout_choice_grid;
cmsmastersShortcodes.cmsmasters_portfolio.fields.layout_mode.descr = cmsmasters_theme_shortcodes.portfolio_field_layout_mode_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.columns.descr = cmsmasters_theme_shortcodes.portfolio_field_col_count_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_theme_shortcodes.portfolio_field_col_count_descr_note + "<br />" + cmsmasters_theme_shortcodes.portfolio_field_col_count_descr_note_custom + "</span>"; 
cmsmastersShortcodes.cmsmasters_portfolio.fields.metadata_grid.descr = cmsmasters_theme_shortcodes.portfolio_field_metadata_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.metadata_puzzle.descr = cmsmasters_theme_shortcodes.portfolio_field_metadata_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.gap.descr = cmsmasters_theme_shortcodes.portfolio_field_gap_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.filter.descr = cmsmasters_theme_shortcodes.portfolio_field_filter_descr;
cmsmastersShortcodes.cmsmasters_portfolio.fields.sorting.descr = cmsmasters_theme_shortcodes.portfolio_field_sorting_descr;


var cmsmasters_portfolio_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_portfolio.fields) {
	if (id === 'columns') {
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['def'] = '3';
		
		
		cmsmasters_portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else if (id === 'metadata_grid') {
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['def'] = 'title,excerpt,more,categories,price';
		
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['more'] = cmsmasters_shortcodes.choice_more;
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['price'] = cmsmasters_theme_shortcodes.portfolio_price;
		
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['comments'];
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['likes'];
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['rollover'];
		
		cmsmasters_portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else if (id === 'metadata_puzzle') {
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['def'] = 'title,price';
		
		cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['price'] = cmsmasters_theme_shortcodes.portfolio_price;
		
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['rollover'];
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['categories'];
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['comments'];
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id]['choises']['likes'];
		
		
		cmsmasters_portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else if (id === 'filter_text') { 
		delete cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	} else {
		cmsmasters_portfolio_new_fields[id] = cmsmastersShortcodes.cmsmasters_portfolio.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_portfolio.fields = cmsmasters_portfolio_new_fields;



/**
 * Quotes Extend
 */
var cmsmasters_quotes_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_quotes.fields) {
	if (id === 'mode') {
		cmsmasters_quotes_new_fields[id] = cmsmastersShortcodes.cmsmasters_quotes.fields[id];
		
		
		cmsmasters_quotes_new_fields['type'] = { 
			type : 		'radio', 
			title : 	cmsmasters_theme_shortcodes.quotes_field_slider_type_title, 
			descr : 	cmsmasters_theme_shortcodes.quotes_field_slider_type_descr, 
			def : 		'box', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'box' : 	cmsmasters_theme_shortcodes.quotes_field_type_choice_box, 
						'center' : 	cmsmasters_theme_shortcodes.quotes_field_type_choice_center 
			}, 
			depend : 	'mode:slider' 
		};
	} else {
		cmsmasters_quotes_new_fields[id] = cmsmastersShortcodes.cmsmasters_quotes.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_quotes.fields = cmsmasters_quotes_new_fields;



/**
 * Posts Slider Extend
 */
 
cmsmastersShortcodes.cmsmasters_posts_slider.fields.post_type['choises']['project'] = cmsmasters_theme_shortcodes.posts_slider_field_poststype_choice_project;
cmsmastersShortcodes.cmsmasters_posts_slider.fields.portfolio_categories.title = cmsmasters_theme_shortcodes.posts_slider_field_poststype_choice_project;
cmsmastersShortcodes.cmsmasters_posts_slider.fields.portfolio_categories.descr = cmsmasters_theme_shortcodes.posts_slider_field_pjcateg_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_theme_shortcodes.posts_slider_field_pjcateg_descr_note + "</span>", 
cmsmastersShortcodes.cmsmasters_posts_slider.fields.columns.descr = cmsmasters_theme_shortcodes.posts_slider_field_col_count_descr;
cmsmastersShortcodes.cmsmasters_posts_slider.fields.portfolio_metadata.title = cmsmasters_theme_shortcodes.posts_slider_field_pjmeta_title;
cmsmastersShortcodes.cmsmasters_posts_slider.fields.portfolio_metadata.descr = cmsmasters_theme_shortcodes.posts_slider_field_pjmeta_descr;
 
var cmsmasters_posts_slider_new_fields = {};


for (var id in cmsmastersShortcodes.cmsmasters_posts_slider.fields) {
	if (id === 'columns') {
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['def'] = '3';
		
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['depend'];  
		
		
		cmsmasters_posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else if (id === 'amount') {
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else if (id === 'blog_metadata') {
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['def'] = 'title,excerpt,date,categories,author,comments,likes,more';
		
		
		cmsmasters_posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else if (id === 'portfolio_metadata') {
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['def'] = 'title,excerpt,price,more,subtitle';
		
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises']['subtitle'] = cmsmasters_theme_shortcodes.portfolio_subtitle;
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises']['price'] = cmsmasters_theme_shortcodes.portfolio_price;
		cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises']['more'] = cmsmasters_shortcodes.choice_more;
		
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises']['categories']; 
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises']['comments']; 
		delete cmsmastersShortcodes.cmsmasters_posts_slider.fields[id]['choises']['likes']; 
		
		cmsmasters_posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	} else {
		cmsmasters_posts_slider_new_fields[id] = cmsmastersShortcodes.cmsmasters_posts_slider.fields[id];
	}
}


cmsmastersShortcodes.cmsmasters_posts_slider.fields = cmsmasters_posts_slider_new_fields;

