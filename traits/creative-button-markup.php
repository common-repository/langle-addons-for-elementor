<?php
/**
 * Trait to load markup for creative button
 */
namespace Langle_Addons\Elementor\Traits;

defined( 'ABSPATH' ) || exit;
trait Creative_Button_Markup {

    public function render_tellus_markup($settings) {
        $this->add_render_attribute( 'wrap', 'class', 'la-creative-btn-wrap' );
        $this->add_render_attribute( 'button', 'class', [ 'la-creative-btn', 'la-stl--' . $settings['btn_style'], 'la-eft--' .$settings['tellus_effect'] ] );

        $this->add_link_attributes( 'button', $settings['button_link'] );

		$wrap_attr = $this->get_render_attribute_string( 'wrap' );
		$btn_attr = $this->get_render_attribute_string( 'button' );
		$btn_txt = $settings['button_text'];
		

		$markup = "<div $wrap_attr>";
		$markup .="<a $btn_attr>$btn_txt</a>";
		$markup .= "</div>";
        echo wp_kses_post( $markup );
    }

    public function render_symbolic_markup($settings){
        $this->add_render_attribute( 'wrap', 'class', 'la-creative-btn-wrap' );
        $this->add_render_attribute( 'button', 'class', [ 'la-creative-btn', 'la-stl--' . $settings['btn_style'], 'la-eft--' .$settings['symbolic_effect'] ] );

        $this->add_link_attributes( 'button', $settings['button_link'] );

		$wrap_attr = $this->get_render_attribute_string( 'wrap' );
		$btn_attr = $this->get_render_attribute_string( 'button' );
		$btn_txt = $settings['button_text'];
		$icon = $settings['icon']['value'] ? $settings['icon']['value'] : '';

		$markup = "<div $wrap_attr>";
		$markup .= "<a $btn_attr>$btn_txt<i aria-hidden=\"true\" class=\"$icon\"></i></a>";
		$markup .= "</div>";
        echo wp_kses_post( $markup );
    }

    public function render_iconic_markup($settings){
		$this->add_render_attribute( 'wrap', 'class', 'la-creative-btn-wrap' );
        $this->add_render_attribute( 'button', 'class', [ 'la-creative-btn', 'la-stl--' . $settings['btn_style'], 'la-eft--' .$settings['iconic_effect'] ] );

        $this->add_link_attributes( 'button', $settings['button_link'] );

		$wrap_attr = $this->get_render_attribute_string( 'wrap' );
		$btn_attr = $this->get_render_attribute_string( 'button' );
		$btn_txt = $settings['button_text'];
		$icon = $settings['icon']['value'] ? $settings['icon']['value'] : '';

		$markup = "<div $wrap_attr>";
		$markup .= "<a $btn_attr><span>$btn_txt</span><i aria-hidden=\"true\" class=\"$icon\"></i></a>";
		$markup .= "</div>";
        echo wp_kses_post( $markup );
    }

    public function render_posuere_markup($settings){
		$this->add_render_attribute( 'wrap', 'class', 'la-creative-btn-wrap' );
        $this->add_render_attribute( 'button', 'class', [ 'la-creative-btn', 'la-stl--' . $settings['btn_style'], 'la-eft--' .$settings['posuere_effect'] ] );
        $this->add_link_attributes( 'button', $settings['button_link'] );

		if( 'aliquet' == $settings['posuere_effect'] || 'massa' == $settings['posuere_effect'] || 'metus' == $settings['posuere_effect'] ) {
			$this->add_render_attribute( 'button', 'data-text', $settings['button_text'] );
		}

		$wrap_attr = $this->get_render_attribute_string( 'wrap' );
		$btn_attr = $this->get_render_attribute_string( 'button' );
		$btn_txt = $settings['button_text'];

		if( 'aliquet' == $settings['posuere_effect'] || 'massa' == $settings['posuere_effect'] || 'sagittis' == $settings['posuere_effect'] ) {
			$btn_txt = '<span>'.esc_html($btn_txt).'</span>';
		}elseif('metus' == $settings['posuere_effect']){
			$btn_txt = $this->split_word($btn_txt);
		}

		$markup = "<div $wrap_attr>";
        $markup .="<a $btn_attr>$btn_txt</a>";
		$markup .= "</div>";
        echo wp_kses_post( $markup );
    }

    public function render_sodales_markup($settings){
		$this->add_render_attribute( 'wrap', 'class', 'la-creative-btn-wrap' );
        $this->add_render_attribute( 'button', 'class', [ 'la-creative-btn', 'la-stl--' . $settings['btn_style'], 'la-eft--' .$settings['sodales_effect'] ] );
        $this->add_link_attributes( 'button', $settings['button_link'] );

		$wrap_attr = $this->get_render_attribute_string( 'wrap' );
		$btn_attr = $this->get_render_attribute_string( 'button' );
		$btn_txt = $settings['button_text'];

		if( 'upward' == $settings['sodales_effect'] || 'render' == $settings['sodales_effect'] || 'reshape' == $settings['sodales_effect'] || 'exploit' == $settings['sodales_effect'] ) {
			$btn_txt = '<span>'.esc_html($btn_txt).'</span>';
		} elseif ( 'newbie' == $settings['sodales_effect'] || 'downhill' == $settings['sodales_effect'] ) {
			$btn_txt = '<span><span>'.esc_html($btn_txt).'</span></span>';
		} elseif ( 'bloom' == $settings['sodales_effect'] ) {
			$btn_txt = '<div></div><span>'.esc_html($btn_txt).'</span>';
		} elseif ( 'roundup' == $settings['sodales_effect'] ) {
			$btn_txt = '<svg aria-hidden="true" class="progress" width="70" height="70" viewbox="0 0 70 70"> <path class="progress__circle" d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z" /> <path class="progress__path" d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z" pathLength=".9" /></svg><span>'.esc_html($btn_txt).'</span>';
		} elseif ( 'expandable' == $settings['sodales_effect'] ) {
			$icon = $settings['icon']['value'] ? $settings['icon']['value'] : '';
			$btn_txt = '<span class="text">'.esc_html($btn_txt).'</span><span class="icon"><i aria-hidden="true" class="'.esc_attr($icon).'"></i></span>';
		}

		$markup = "<div $wrap_attr>";
        $markup .= "<a $btn_attr>$btn_txt</a>";
		$markup .= "</div>";
        echo wp_kses_post( $markup );
    }

    public function split_word( $text ){
		$text_array = str_split($text);
		$base = 0.045;
		$markup = '';
		foreach ( $text_array as $key => $value ) {
			$delay = $base * ($key+1);
			if(trim($value)){
				$markup .= '<span style="--delay:'.$delay.'s">'.$value.'</span>';
			}else{
				$markup .= '<span>&nbsp;</span>';
			}
		}
		return wp_kses_post( $markup );
    }
}