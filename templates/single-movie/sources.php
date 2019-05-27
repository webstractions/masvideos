<?php
/**
 * Sources Template
 *
 * This template can be overridden by copying it to yourtheme/masvideos/single-movie/sources.php.
 *
 * HOWEVER, on occasion MasVideos will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package MasVideos/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $movie;

if ( ! $movie || ! ( $movie->has_sources() ) ) {
    return;
}

$sources = $movie->get_sources();

?>
<table>
    <thead>
        <tr>
            <th><?php echo esc_html__( 'Links', 'masvideos' ) ?></th>
            <th><?php echo esc_html__( 'Quality', 'masvideos' ) ?></th>
            <th><?php echo esc_html__( 'Language', 'masvideos' ) ?></th>
            <th><?php echo esc_html__( 'Player', 'masvideos' ) ?></th>
            <th><?php echo esc_html__( 'Date Added', 'masvideos' ) ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ( $sources as $key => $source ) : ?>
            <?php
                $source_content = '';
                $source_choice = ! empty( $source['choice'] ) ? $source['choice'] : '';

                if ( $source_choice == 'movie_embed' && ! empty( $source['embed_content'] ) ) {
                    $source_content = '<div class="wp-video">' . apply_filters( 'the_content', $source['embed_content'] ) . '</div>';
                } elseif ( $source_choice == 'movie_url' && ! empty( $source['link'] ) ) {
                    $source_content = do_shortcode('[video src="' . $source['link'] . '"]');
                }

                if( empty( $source_content ) ) {
                    continue;
                }
            ?>
            <tr>
                <td>
                    <a href="#" class="movie-play-source" data-content="<?php echo esc_attr( htmlspecialchars( $source_content ) ); ?>">
                        <span><?php echo apply_filters( 'masvideos_play_icon', esc_html__( 'Play Now', 'masvideos' ) ); ?></span>
                    </a>
                </td>
                <td>
                    <?php if( ! empty( $source['quality'] ) ) {
                        echo wp_kses_post( $source['quality'] );
                    } ?>
                </td>
                <td>
                    <?php if( ! empty( $source['language'] ) ) {
                        echo wp_kses_post( $source['language'] );
                    } ?>
                </td>
                <td>
                    <?php if( ! empty( $source['player'] ) ) {
                        echo wp_kses_post( $source['player'] );
                    } ?>
                </td>
                <td>
                    <?php if( ! empty( $source['date_added'] ) ) {
                        echo wp_kses_post( $source['date_added'] );
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>