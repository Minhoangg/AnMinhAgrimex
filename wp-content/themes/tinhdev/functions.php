<?php
require __DIR__ . '/vendor/autoload.php';

use TinhDev\base\Base;
use TinhDev\components\Header;
use TinhDev\components\Slider;
use TinhDev\components\AboutUs;
use TinhDev\components\BlogDefault;
use TinhDev\components\ContactOnline;
use TinhDev\components\HomeContactUs;
use TinhDev\components\Footer;
use TinhDev\components\Archive;
use TinhDev\components\ArchiveProduct;
use TinhDev\components\BlogGallery;
use TinhDev\components\Page;
use TinhDev\components\Single;
use TinhDev\components\SingleProduct;
use TinhDev\components\PageNotFound;
use TinhDev\components\ProductFeatured;
use TinhDev\components\VideoComment;
use TinhDev\components\BlogPage;
use TinhDev\components\AboutPage;
use TinhDev\components\ContactPage;

$base = new Base();
$base->init();


add_action('init', 'remove_functions', 15);
function remove_functions()
{
    remove_action('genesis_header', 'genesis_do_header');
    remove_action('genesis_footer', 'genesis_do_footer');
    remove_action('genesis_sidebar', 'genesis_do_sidebar');
    remove_action('genesis_loop', 'genesis_do_loop');
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}

add_action('init', 'add_functions', 15);
function add_functions()
{
    add_action('genesis_header', 'header_components');
    add_action('genesis_loop', 'home_components');
    add_action('genesis_loop', 'single_components');
    add_action('genesis_loop', 'page_components');
    add_action('genesis_loop', 'archive_components');
    add_action('genesis_footer', 'footer_components');
    add_action('genesis_loop', 'search_components');
    add_action('genesis_loop', 'page_not_found_components');
    add_action('genesis_loop', 'blog_components');
    add_action('genesis_loop', 'about_components');
    add_action('genesis_loop', 'contact_components');
}

function header_components()
{
    Header::render();
}

function home_components()
{
    if (is_home()) :
        Slider::render();
        // AboutUs::render();
        //  HomeContactUs::render();
        // VideoComment::render();

        BlogDefault::render();
        ProductFeatured::render();
    endif;
}

function blog_components()
{
    if (is_page('bai-viet')) :
        BlogPage::render();
    endif;
}

function about_components()
{
    if (is_page('gioi-thieu')) :
        AboutPage::render();
    elseif (is_page('ban-lanh-dao')) :

    elseif (is_page('danh-hieu-va-giai-thuong')) :

    elseif (is_page('cau-chuyen-lich-su')) :

    elseif (is_page('van-hoa-an-minh')) :


    endif;
}

function contact_components()
{
    if (is_page('lien-he')) :
        ContactPage::render();
    endif;
}


function single_components()
{
    if (is_single()) :
        if (class_exists('WooCommerce') && is_woocommerce()) :
            SingleProduct::render();
        else :
            Single::render();
        endif;
    endif;
}

function page_components()
{
    if (is_page() && !is_page_template()) :
        Page::render();
    endif;
}


function archive_components()
{
    if (is_archive()) :
        if (class_exists('WooCommerce') && is_woocommerce()) :
            ArchiveProduct::render();
        else :
            Archive::render();
        endif;
    endif;
}


function search_components()
{
    if (is_search()) :
        if (class_exists('WooCommerce') && is_woocommerce()) :
            ArchiveProduct::render();
        else :
            Archive::render();
        endif;
    endif;
}


function page_not_found_components()
{
    if (is_404()) :
        PageNotFound::render();
    endif;
}


function footer_components()
{
    Footer::render();
    // ContactOnline::render();
}


function mmenu_setup()
{
    $header = get_field('header', 'option');
    ?>
    <script>
        document.addEventListener("click", (evnt) => {
            if (evnt.target?.closest?.('a[href^="#/"]')) {
                evnt.preventDefault();
                alert("Thank you for clicking, but that's a demo link.");
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            new Mmenu("#menu-header-mobile", {
                theme: "white",
                offCanvas: {
                    position: "bottom"
                },
                navbars: [{
                    height: 2,
                    content: [
                        '<a target="_blank" href="tel:<?= $header['phone'] ?? '' ?>" class="fa fa-phone"></a>',
                        '<a class="mmenu-logo" href="/"><img class="img-fluid" height="50" src="<?= $header['logo'] ?? '' ?>" alt="<?php wp_title() ?>"></a>',
                        '<a target="_blank" href="mailto:<?= $header['email'] ?? '' ?>" class="fa fa-envelope"></a>'
                    ]
                },
                    {
                        content: ["<form action='/' method='get' class='p-3 input-group mb-3'>" +
                        "<input class='form-control' type='text' name='s' id='search' value='<?php the_search_query(); ?>' />" +
                        "<button class='btn btn-outline-secondary'><?php echo esc_attr_x('Tìm kiếm', 'tinhdev') ?></button>" + "</form>"
                        ]
                    },
                    {
                        content: ["prev", "title"]
                    }
                ]
            }, {});
        });
    </script>
<?php }

add_action('wp_footer', 'mmenu_setup');

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', FALSE);
    } elseif (is_tag()) {
        $title = single_tag_title('', FALSE);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', FALSE));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', FALSE);
    }

    return $title;
});

remove_filter('the_excerpt', 'wpautop');

add_filter('rest_prepare_post', 'my_filter_post', 10, 3);
function my_filter_post($data, $post, $context)
{

    // Does this have categories?
    if (!empty($data->data['categories'])) {
        $category_name = [];
        // Loop through them all
        foreach ($data->data['categories'] as $key => $category_id) {
            // Get the actual Category Object
            $category = get_category($category_id);
            $category_name[$key]['id'] = $category_id;
            $category_name[$key]['name'] = $category->name;
        }
    }
    $data->data['categories'] = $category_name;

    if (!empty($data->data['featured_media'])) {
        $data->data['featured_media'] = wp_get_attachment_url($data->data['featured_media']);
    } else {
        $data->data['featured_media'] = "";
    }

    return $data;
}


add_filter('rest_prepare_category', 'my_filter_category', 10, 3);
function my_filter_category($data, $post, $context)
{
    $data->data['featured_media'] = get_field(
        'category_featured_media',
        get_term($data->data['id'])
    ) ?? '';

    return $data;
}

add_action('after_setup_theme', 'yourtheme_setup');

function yourtheme_setup()
{
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
