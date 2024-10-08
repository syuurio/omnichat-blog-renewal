<?php
$lang = pll_current_language();
$forms = array(
	'en' => 'fb062923-0660-43da-8ad4-2863fd2c6eb4',
  'tw' => 'ec035834-19ed-43e1-bce0-ecd68bd74d6c', 
  'hk' => '6bd6890b-6f6d-4084-a7a6-32d4e84c616c'
); 
$portalID = "4971687"; 
$region = "na1";
?>
<div id="inquiry-form" class="inquiry-form" style="visibility: hidden">
  <p class="inquiry-form__title dynamic-title font-outfit">
    <?= $lang === 'en' ? 'Book a Consultation' : '立即填表預約諮詢' ?>
  </p>
  <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
  <script> (() => { hbspt.forms.create({ region: "<?= $region ?>", portalId: "<?= $portalID ?>", formId: "<?= $forms[$lang] ?>", }); HubSpotForms.onFormReady(customize); function customize() { const iframe = document.querySelector(".hs-form-iframe"); const iDocument = iframe.contentDocument; const radioField = iDocument.querySelector(".hs-fieldtype-radio"); const radioGroupTitle = document.createElement("p"); radioGroupTitle.style = "font-size: 18px; color:#1c1c1c; margin-block-end: 10px;"; radioGroupTitle.textContent = '<?= $lang === "en" ? "Main business markets" : "主要經營市場" ?>'; radioField.insertAdjacentElement("afterbegin", radioGroupTitle); const footerText = iDocument.createElement("p"); const submit = iDocument.querySelector(".hs-submit"); const submitButton = submit.querySelector('input[type="submit"]'); submitButton.value = '<?= $lang === "en" ? "Submit" : "確認" ?>'; footerText.style = "font-family: Inter, sans-serif; font-size: 10px; color:#979797; text-align: center; margin-block-start: 0; margin-block-end: 1.25rem;"; footerText.textContent = "We’ll share a copy of this guide and send you content and updates about Omnichat’s products as we continue to build the world’s leading CDP. We use your information according to our privacy policy. You can update your preferences at any time."; submit.insertAdjacentElement("afterbegin", footerText); } })(); </script>
</div>