<?
               $Disclosure = RV_SalesOps_Consent_Client_Lead::get_client_by_siteid($siteParams->SiteID);
				$disclosureText = $Disclosure->get_disclosure_text();
				$Text = new RV_TextImage(420, 12 ,'black', 'white', true);
				$Text->seed_noise_generator($siteParams->SiteID);
				$disclosureText = $Text->create_tag_from_string(strip_tags($disclosureText));
				echo $Disclosure->get_disclosure_form_fields();
?>
