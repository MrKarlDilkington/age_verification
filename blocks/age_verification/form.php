<?php defined('C5_EXECUTE') or die('Access Denied.');

$al = Core::make('helper/concrete/asset_library');

if ($fID > 0) {
    $fo = File::getByID($fID);
    if (!is_object($fo)) {
        unset($fo);
    }
}

echo Core::make('helper/concrete/ui')->tabs(array(
    array('settings', t('Settings'), true),
    array('colors-fontsizes', t('Colors and Font Sizes')),
));
?>

<style>
.two-columns {
    width: 50%;
    float: left;
}
.two-column-colors {
    width: 49%;
    display: inline-block;
}
.pixel-input-width {
    width: 100px;
}
.form-group input.validation-error {
    border: 1px solid red;
}
.validation-message {
    margin-top: 30px;
    color: red;
    text-align: center;
}
</style>

<div id="validate"></div>

<div id="ccm-tab-content-settings" class="ccm-tab-content">

    <!-- Form Image -->
    <div class="form-group">
        <?php echo $form->label('fID', t('Form Image'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('The form image is an optional logo or image that will be placed at the top of the form.'); ?>"></i>
        <?php echo $al->image('ccm-b-file1', 'fID', t('Select Image'), $fo); ?>
    </div>

    <!-- Extra Text -->
    <div class="form-group">
       <?php echo $form->label('content', t('Extra Text'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('Extra text is optional text displayed at the bottom of the form. To provide a uniform appearance, the CSS styles have been set to override any colors or font sizes chosen through the content editor.'); ?>"></i>
        <?php
        $editor = Core::make('editor');
        echo $editor->outputBlockEditModeEditor('content', $content);
        ?>
    </div>

    <!-- Minimum Age -->
    <div class="form-group two-columns">
        <?php echo $form->label('minimumAge', t('Minimum Age'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('The minimum age in years required to enter the website. If set to 0, the minimum age will default to 1 year.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('minimumAge', $minimumAge ? $minimumAge : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('years old'); ?></span>
        </div>
    </div>

    <!-- Cookie Expiration -->
    <div class="form-group two-columns">
        <?php echo $form->label('cookieExpiration', t('Cookie Expiration'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('The cookie expiration is the number of days that a cookie will expire after it is set. If set to 0, the cookie expiration will default to 1 day.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('cookieExpiration', $cookieExpiration ? $cookieExpiration : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '3', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('day(s)'); ?></span>
        </div>
    </div>

    <!-- Form Image Width -->
    <div class="form-group two-columns">
        <?php echo $form->label('formImageWidth', t('Form Image Width'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('The form image width is the width in pixels that an image will be proportionally resized to. If set to 0, the image width will default to 500px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('formImageWidth', $formImageWidth ? $formImageWidth : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '4', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Extra Text Width -->
    <div class="form-group two-columns">
        <?php echo $form->label('extraTextWidth', t('Extra Text Width'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('The extra text width is the width in pixels of the extra text container element. If set to 0, the extra text width will default to 500px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('extraTextWidth', $extraTextWidth ? $extraTextWidth : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '4', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Page Redirect Address-->
    <div class="form-group">
        <?php echo $form->label('ageRedirectPage', t('Page Redirect Address'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('The page redirect address is the address that the browser redirects to if an age entered is less than the set minimum age. The address must start with http or https. If no address is set, the default address will be https://www.google.com.'); ?>"></i>
        <?php echo $form->text('ageRedirectPage', $ageRedirectPage, array('placeholder' => 'http://www.example.com'))?>
    </div>

</div>

<div id="ccm-tab-content-colors-fontsizes" class="ccm-tab-content">

    <!-- Background Overlay Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Background Overlay Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('overlayBackgroundColor', $overlayBackgroundColor ? $overlayBackgroundColor : '#000000', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Form Text Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Form Text Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('formTextColor', $formTextColor ? $formTextColor : '#FFFFFF', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Validate Warning Text Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Validate Warning Text Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('validateTextColor', $validateTextColor ? $validateTextColor : '#FF0000', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Extra Text Link Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Extra Text Link Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('extraTextLinkColor', $extraTextLinkColor ? $extraTextLinkColor : '#80FFFF', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Extra Text Link Hover Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Extra Text Link Hover Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('extraTextHoverColor', $extraTextHoverColor ? $extraTextHoverColor : '#808080', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Submit Button Border Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Submit Button Border Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('submitBorderColor', $submitBorderColor ? $submitBorderColor : '#808080', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Submit Button Background Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Submit Button Background Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('submitBackgroundColor', $submitBackgroundColor ? $submitBackgroundColor : '#E8DE6E', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Submit Text Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Submit Text Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('submitTextColor', $submitTextColor ? $submitTextColor : '#000000', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Submit Text Hover Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Submit Text Hover Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('submitTextHoverColor', $submitTextHoverColor ? $submitTextHoverColor : '#FFFFFF', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Submit Background Hover Color -->
    <div class="form-group two-column-colors">
        <?php echo '<label class="control-label">' . t('Submit Background Hover Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('submitBackgroundHoverColor', $submitBackgroundHoverColor ? $submitBackgroundHoverColor : '#592726', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Submit Background Active Color -->
    <div class="form-group two-column-colors-last">
        <?php echo '<label class="control-label">' . t('Submit Background Active Color') . '</label>'; ?>
        <br>
        <?php
        $color = Core::make('helper/form/color');
        $color->output('submitBackgroundActiveColor', $submitBackgroundActiveColor ? $submitBackgroundActiveColor : '#C0C0C0', array('preferredFormat' => 'hex'));
        ?>
    </div>

    <!-- Request Text Font Size -->
    <div class="form-group two-columns">
        <?php echo $form->label('requestTextFontSize', t('Request Text Font Size'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('If set to 0, the default request text font size will be 23px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('requestTextFontSize', $requestTextFontSize ? $requestTextFontSize : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Validate Text Font Size -->
    <div class="form-group two-columns">
        <?php echo $form->label('validateTextFontSize', t('Validate Text Font Size'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('If set to 0, the default validate text font size will be 20px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('validateTextFontSize', $validateTextFontSize ? $validateTextFontSize : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Input Text Font Size -->
    <div class="form-group two-columns">
        <?php echo $form->label('inputTextFontSize', t('Input Text Font Size'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('If set to 0, the default input text font size will be 27px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('inputTextFontSize', $inputTextFontSize ? $inputTextFontSize : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Submit Text Font Size -->
    <div class="form-group two-columns">
        <?php echo $form->label('submitTextFontSize', t('Submit Text Font Size'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('If set to 0, the default submit text font size will be 23px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('submitTextFontSize', $submitTextFontSize ? $submitTextFontSize : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Label Text Font Size -->
    <div class="form-group two-columns">
        <?php echo $form->label('labelTextFontSize', t('Label Text Font Size'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('If set to 0, the default label text font size will be 20px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('labelTextFontSize', $labelTextFontSize ? $labelTextFontSize : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>

    <!-- Extra Text Font Size -->
    <div class="form-group two-columns">
        <?php echo $form->label('extraTextFontSize', t('Extra Text Font Size'));?>
        <i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo t('If set to 0, the default extra text font size will be 16px.'); ?>"></i>
        <div class="input-group pixel-input-width">
        <?php echo $form->text('extraTextFontSize', $extraTextFontSize ? $extraTextFontSize : '0', array('style' => 'text-align: center; width: 75px;', 'maxlength' => '2', 'class' => 'validation'))?><span class="input-group-addon"><?php echo t('px'); ?></span>
        </div>
    </div>
</div>

<script>
$("#ccm-form-submit-button").click(function(event){
    $('.validation').each (function() {
        if (isNaN($(this).val()) || $(this).val() < '0') {
            $(this).addClass('validation-error');
            $('#validate').text('<?php echo t("Valid input values are 0 and positive numbers."); ?>')
                          .addClass('well validation-message');
            event.preventDefault();
        } else {
            $(this).removeClass('validation-error');
        }
    });
});
</script>