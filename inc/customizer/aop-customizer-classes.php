<?php
/**
 * Extend custom classes for customizer
 *
 * @package Awesome_One_Page
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Image control by radtion button 
 */
class Aop_Image_Radio_Control extends WP_Customize_Control {

	public function render_content() {

	if ( empty( $this->choices ) )
		return;

	$name = '_customize-radio-' . $this->id;

	?>
	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	<ul class="controls" id = 'aop-img-container'>

		<?php	foreach ( $this->choices as $value => $label ) :

			$class = ($this->value() == $value)?'aop-radio-img-selected aop-radio-img-img':'aop-radio-img-img';

			?>

			<li style="display: inline;">

			<label>

				<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

				<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_attr( $class) ; ?>' />

			</label>

			</li>

		<?php	endforeach;	?>

	</ul>

	<?php
	}
}