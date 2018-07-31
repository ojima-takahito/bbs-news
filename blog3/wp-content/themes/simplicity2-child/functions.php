<?php //子テーマ用関数

//親skins の取得有無の設定
function include_parent_skins(){
  return true; //親skinsを含める場合はtrue、含めない場合はfalse
}

//管理画面での記事一覧カラムカスタマイズ
//WordpressPoplarPostのビューカウントを表示する
function admin_posts_columns($columns) {
$columns['subtitle'] = "ビュー";
return $columns;
}
function add_admincolumn($column_name, $post_id) {
if( $column_name == 'subtitle' ) {
echo wpp_get_views($post_id, 'monthly', true);
}
}
if ( function_exists('wpp_get_views') ) {
add_filter( 'manage_posts_columns', 'admin_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_admincolumn', 10, 2 );
}

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

remove_filter( 'the_content', 'wpautop' );
function shortcode_hurl(){
	$home_url = home_url( '/' );
	return $home_url;
}
add_shortcode('hurl', 'shortcode_hurl');

//Custom CSS Widget
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
    add_meta_box('custom_css', '個別CSS', 'custom_css_input', 'post', 'normal', 'high');
    add_meta_box('custom_css', '個別CSS', 'custom_css_input', 'page', 'normal', 'high');
}
function custom_css_input() {
    global $post;
    echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
    echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
    if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    $custom_css = $_POST['custom_css'];
    update_post_meta($post_id, '_custom_css', $custom_css);
}
function insert_custom_css() {
    if (is_page() || is_single()) {
        if (have_posts()) : while (have_posts()) : the_post();
            if (get_post_meta(get_the_ID(), '_custom_css', true) !='') {
                echo "<style type=\"text/css\" media=\"all\">\n".get_post_meta(get_the_ID(), '_custom_css', true)."\n</style>\n";
        }
        endwhile; endif;
        rewind_posts();
    }
}
//Custom JavaScript Widget
add_action('admin_menu', 'custom_js_hooks');
add_action('save_post', 'save_custom_js');
add_action('wp_head','insert_custom_js');
function custom_js_hooks() {
    add_meta_box('custom_js', '個別JavaScript', 'custom_js_input', 'post', 'normal', 'high');
    add_meta_box('custom_js', '個別JavaScript', 'custom_js_input', 'page', 'normal', 'high');
}
function custom_js_input() {
    global $post;
    echo '<input type="hidden" name="custom_js_noncename" id="custom_js_noncename" value="'.wp_create_nonce('custom-js').'" />';
    echo '<textarea name="custom_js" id="custom_js" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_js',true).'</textarea>';
}
function save_custom_js($post_id) {
    if (!wp_verify_nonce($_POST['custom_js_noncename'], 'custom-js')) return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    $custom_js = $_POST['custom_js'];
    update_post_meta($post_id, '_custom_js', $custom_js);
}
function insert_custom_js() {
    if (is_page() || is_single()) {
        if (have_posts()) : while (have_posts()) : the_post();
            if (get_post_meta(get_the_ID(), '_custom_js', true) !='') {
                echo "<script type=\"text/javascript\">\n".get_post_meta(get_the_ID(), '_custom_js', true)."\n</script>\n";
            }
        endwhile; endif;
        rewind_posts();
    }
}


//以下にSimplicity子テーマ用の関数を書く
