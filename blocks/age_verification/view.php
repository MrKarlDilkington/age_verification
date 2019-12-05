<?php defined('C5_EXECUTE') or die('Access Denied.');

$currentPage = Page::getCurrentPage();
$blockType = BlockType::getByHandle('age_verification');
$localPath = app('helper/concrete/urls')->getBlockTypeAssetsURL($blockType);

$fileObject = File::getByID($fID);
if (is_object($fileObject)) {
    $formImage = app('helper/image')->getThumbnail($fileObject, $formImageWidth, 9999, false);
}
?>

<?php if ($currentPage->isEditMode()) { ?>
    <div style="background: white; border: 1px solid black; padding: 10px; display: inline-block;"><i class="fa fa-birthday-cake" style="margin-right: 7px;"></i><?php echo t('Edit Age Verification'); ?></div>
<?php } ?>

<?php
// if users can not see the tool bar, then the style and script tag are displayed
if (is_object($currentPage)) {
   $currentPagePermissions = new Permissions($currentPage);
   if (!$currentPagePermissions->canViewToolbar()) {
?>
    <style>
        .ccm-block-age_verification .verify-overlay{background:<?php if ($overlayBackgroundColor) { echo $overlayBackgroundColor; } ?>;}
        .ccm-block-age_verification .verify-centering{background:<?php if ($overlayBackgroundColor) { echo $overlayBackgroundColor; } ?>;}
        .ccm-block-age_verification .verify-logo-container{max-width:<?php if ($formImageWidth) { echo $formImageWidth; } else { echo 500;} ?>px;}
        .ccm-block-age_verification .verify-request-text{font-size:<?php if ($requestTextFontSize) { echo $requestTextFontSize; } else { echo 23; } ?>px;color:<?php if ($formTextColor) { echo $formTextColor; } ?>;}
        .ccm-block-age_verification .verify-validate-text{font-size:<?php if ($validateTextFontSize) { echo $validateTextFontSize; } else { echo 20; } ?>px;color:<?php if ($validateTextColor) { echo $validateTextColor; } ?>;}
        .ccm-block-age_verification .verify-extra-text,
        .ccm-block-age_verification .verify-extra-text h1,
        .ccm-block-age_verification .verify-extra-text h2,
        .ccm-block-age_verification .verify-extra-text h2,
        .ccm-block-age_verification .verify-extra-text h4,
        .ccm-block-age_verification .verify-extra-text h5,
        .ccm-block-age_verification .verify-extra-text h6,
        .ccm-block-age_verification .verify-extra-text p,
        .ccm-block-age_verification .verify-extra-text span
        {font-size:<?php if ($extraTextFontSize) { echo $extraTextFontSize; } else { echo 16; } ?>px !important;max-width:<?php if ($extraTextWidth) { echo $extraTextWidth; } else { echo 500; } ?>px;color:<?php if ($formTextColor) { echo $formTextColor; } ?> !important;}
        .ccm-block-age_verification .verify-extra-text a{color:<?php if ($extraTextLinkColor) { echo $extraTextLinkColor; } ?> !important;}
        .ccm-block-age_verification .verify-extra-text a:link{color:<?php if ($extraTextLinkColor) { echo $extraTextLinkColor; } ?> !important;}
        .ccm-block-age_verification .verify-extra-text a:hover{color:<?php if ($extraTextHoverColor) { echo $extraTextHoverColor; } ?> !important;}
        .ccm-block-age_verification .verify-input-month,
        .ccm-block-age_verification .verify-input-day,
        .ccm-block-age_verification .verify-input-year
        {font-size:<?php if ($inputTextFontSize) { echo $inputTextFontSize; } else { echo 27; } ?>px;}
        .ccm-block-age_verification .verify-input-submit{font-size:<?php if ($submitTextFontSize) { echo $submitTextFontSize; } else { echo 23; } ?>px;border: 2px solid <?php if ($submitBorderColor) { echo $submitBorderColor; } ?>;background:<?php if ($submitBackgroundColor) { echo $submitBackgroundColor; } ?>;color:<?php if ($submitTextColor) { echo $submitTextColor; } ?>;}
        .ccm-block-age_verification .verify-input-submit:hover{color:<?php if ($submitTextHoverColor) { echo $submitTextHoverColor; } ?>;background:<?php if ($submitBackgroundHoverColor) { echo $submitBackgroundHoverColor; } ?>;}
        .ccm-block-age_verification .verify-input-submit:active{background:<?php if ($submitBackgroundActiveColor) { echo $submitBackgroundActiveColor; } ?>;}
        .ccm-block-age_verification .verify-checkbox-label{font-size:<?php if ($labelTextFontSize) { echo $labelTextFontSize; } else { echo 20; } ?>px;color:<?php if ($formTextColor) { echo $formTextColor; } ?>;}
    </style>

    <script src="<?php echo $localPath; ?>/files/placeholdr.min.js"></script>
    <script src="<?php echo $localPath; ?>/files/age_verification.min.js"></script>
    <script>
        $(document).ready(function () {
            if (fgCookie('age') === null ) {
                var minimumAge = <?php if ($minimumAge) { echo $minimumAge; } else { echo 1;} ?>;
                var ageRedirectPage = '<?php if ($ageRedirectPage) { echo $ageRedirectPage; } else { echo 'https://www.google.com'; } ?>';
                var formImage = '<?php if (is_object($formImage)) { echo $formImage->src; } else { echo ''; } ?>';
                var verifyRequestText = '<?php echo t('Please enter your birth date'); ?>';
                var verifyValidateText = '<?php echo t('Please enter a valid birth date'); ?>';
                var verifySubmitText = '<?php echo t('Enter'); ?>';
                var verifyRememberMeText = '<?php echo t('Remember me'); ?>';

                ageOverlayFormMake(formImage, verifyRequestText, verifySubmitText, verifyRememberMeText);

                <?php if ($content) { ?>
                    $('.verify-extra-text').prepend('<?php
                                                    $content = addslashes(str_replace(["\r", "\n", "\t"], "", $content));
                                                    echo $content;
                                                    ?>');
                <?php } ?>

                $('#verify-month').mask('00', {'translation': { 0: {pattern: /[0-9]/ }}});
                $('#verify-day').mask('00', {'translation': { 0: {pattern: /[0-9]/ }}});
                $('#verify-year').mask('0000', {'translation': { 0: {pattern: /[0-9]/ }}});

                $('body').placeholdr();

                var month,
                    day,
                    year;

                $('#verify-month').on('change blur keyup', function () {
                    var verifyInputMonth = parseInt($('#verify-month').val());
                    if (verifyInputMonth > 12 || verifyInputMonth === 0 || isNaN(verifyInputMonth)) {
                        $(this).css('color', 'red');
                        month = false;
                    } else {
                        $(this).css('color', 'black');
                        month = true;
                    }
                });

                $('#verify-day').on('change blur keyup', function () {
                    var verifyInputDay = parseInt($('#verify-day').val());
                    if (verifyInputDay > 31 || verifyInputDay === 0 || isNaN(verifyInputDay)) {
                        $(this).css('color', 'red');
                        day = false;
                    } else {
                        $(this).css('color', 'black');
                        day = true;
                    }
                });

                $('#verify-year').on('change blur keyup', function () {
                    var verifyInputYear = parseInt($('#verify-year').val());
                    if (verifyInputYear > 2030 || verifyInputYear < 1890 || isNaN(verifyInputYear)) {
                        $(this).css('color', 'red');
                        year = false;
                    } else {
                        $(this).css('color', 'black');
                        year = true;
                    }
                });

                $('#verify-input-submit').click(function () {
                    var enteredAgeDate = $('#verify-month').val() + '/';
                    enteredAgeDate += $('#verify-day').val() + '/';
                    enteredAgeDate += $('#verify-year').val();

                    if (month && day && year && ageVerify(minimumAge, enteredAgeDate) && !($('#verify-remember-me').prop('checked'))) {
                        $('.ccm-block-age_verification').remove();
                    } else if (month && day && year && ageVerify(minimumAge, enteredAgeDate) && $('#verify-remember-me').prop('checked')) {
                        fgCookie('age', 'verified', <?php if ($cookieExpiration) { echo $cookieExpiration; } else { echo 1; } ?>);
                        $('.ccm-block-age_verification').remove();
                    } else if (month && day && year && !(ageVerify(minimumAge, enteredAgeDate))) {
                        window.location.href = ageRedirectPage;
                    } else {
                        $('.verify-validate-text').text(verifyValidateText);
                    }
                });
            }
        });
    </script>
<?php
   }
}
