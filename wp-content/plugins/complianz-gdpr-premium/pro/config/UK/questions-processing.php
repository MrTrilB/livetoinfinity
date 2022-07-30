<?php
defined('ABSPATH') or die("you do not have access to this page!");
$this->fields = $this->fields + array(
        'has-wizard-been-completed-processing-uk' => array(
            'step' => 1,
            'section' => 1,
            'source' => 'processing-uk',
            'type' => 'text',
            'default' => '',
			'help' => cmplz_sprintf( __( "To learn what Processing Agreements are and what you need them for, please read this  %sarticle%s", 'complianz-gdpr' ),'<a href="https://complianz.io/what-are-processing-agreements">', '</a>' ),
            'callback' => 'is_wizard_completed',
        ),
        'processor-activities-uk' => array(
            'step' => 2,
            'section' => 1,
            'source' => 'processing-uk',
            'translatable' => true,
            'type' => 'text',
            'default' => '',
            'required' => true,
            'help' => __('E.g. hosting, data storage, payment processing, sending newsletters', 'complianz-gdpr'),
            'label' => __("Describe briefly what activities your processor will perform.", 'complianz-gdpr'),
        ),
        'data-from-whom-uk' => array(
            'step' => 2,
            'section' => 1,
            'source' => 'processing-uk',
            'type' => 'multicheckbox',
            'default' => '',
            'required' => true,
            'label' => __("Who's data will be processed?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('Customers', 'complianz-gdpr'),
                '2' => __('Employees', 'complianz-gdpr'),
                '3' => __('Suppliers', 'complianz-gdpr'),
                '4' => __('Account holders', 'complianz-gdpr'),
                '5' => __('Job applicants', 'complianz-gdpr'),
                '6' => __('Website visitors', 'complianz-gdpr'),
                '7' => __('Patients', 'complianz-gdpr'),
                '8' => __('Leads', 'complianz-gdpr'),
                '9' => __('Members', 'complianz-gdpr'),
                '10' => __('Tenants', 'complianz-gdpr'),
                '11' => __('Other:', 'complianz-gdpr'),
            ),
        ),
        'data-from-whom-other-uk' => array(
            'step' => 2,
            'section' => 1,
            'source' => 'processing-uk',
            'type' => 'text',
            'translatable' => true,
            'default' => '',
            'required' => true,
            'label' => __("Which categories can the persons be placed in?", 'complianz-gdpr'),
            'help' => __('Multiple categories should be separated with a semi-colon.'),
            'condition' => array('data-from-whom-uk' => '11'),
        ),
        'what-kind-of-data-uk' => array(
            'step' => 2,
            'section' => 1,
            'source' => 'processing-uk',
            'type' => 'multicheckbox',
            'default' => '',
            'required' => true,
            'label' => __("What kind of data will be processed by the data processor?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('Name Address City', 'complianz-gdpr'),
                '2' => __('Phone number', 'complianz-gdpr'),
                '3' => __('Email address', 'complianz-gdpr'),
                '4' => __('Browse history', 'complianz-gdpr'),
                '5' => __('IP Address', 'complianz-gdpr'),
                '6' => __('Social Media accounts', 'complianz-gdpr'),
                '7' => __("Photo's", 'complianz-gdpr'),
                '8' => __('Curriculum Vitae', 'complianz-gdpr'),
                '9' => __('Birth Date', 'complianz-gdpr'),
                '10' => __('Marital status', 'complianz-gdpr'),
                '11' => __('Financial data', 'complianz-gdpr'),
                '12' => __('Medical data', 'complianz-gdpr'),
                '13' => __('Other:', 'complianz-gdpr'),
            ),
        ),
        'what-kind-of-data-other-uk' => array(
            'step' => 2,
            'section' => 1,
            'source' => 'processing-uk',
            'type' => 'text',
            'translatable' => true,
            'default' => '',
            'required' => true,
            'label' => __("Which kind of personal data will be processed?", 'complianz-gdpr'),
            'help' => __('Multiple categories should be separated with a semi - colon.'),
            'condition' => array('what-kind-of-data-uk' => '13'),
        ),
        'allow-outside-eu-uk' => array(
            'step' => 2,
            'section' => 1,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("Do you allow data to be processed outside the United Kingdom?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('No, processing outside the UK is not allowed.', 'complianz-gdpr'),
                '2' => __('Yes, but only when the countries share the same security levels concerning privacy.', 'complianz-gdpr'),
            ),
        ),
        // CONTACTGEGEVENS PERSOON - CONTACT DETAILS

        'name_of_processor-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'text',
            'default' => '',
            'required' => true,
            'label' => __("What is the name of the processor?", 'complianz-gdpr'),
        ),

        // HANDLING REQUESTS FROM THOSE involved

        'deal_with_requests-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'multicheckbox',
            'default' => 1,
            'required' => true,
            'label' => __("How will you deal with requests from those involved?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('I will deal with requests from those involved, The processor will forward everything to me.', 'complianz-gdpr'),
                '2' => __('The processor may charge additional costs that it incurs in this context.', 'complianz-gdpr'),
            ),
            'tooltip' => __('An individual can make a subject access request to you verbally or in writing. It can also be made to any part of your organisation (including by social media) and does not have to be to a specific person or contact point.','complianz-gdpr'),
        ),
        'security_measures-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("Which security measures should the Processor take?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('The Processor must at least be able to meet the legal minimum.', 'complianz-gdpr'),
                '2' => __('The Processor must comply with a separate security protocol.', 'complianz-gdpr'),
                '3' => __('I want to be able to choose the required security measures myself.', 'complianz-gdpr'),
            ),
        ),
        'security-protocol-where-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'label' => __("Where can people find this security protocol?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('The protocol is annexed to this agreement.', 'complianz-gdpr'),
                '2' => __('The protocol can be found online via an URL', 'complianz-gdpr'),
            ),
            'condition' => array('security_measures-uk' => '2'),
        ),
        'security-protocol-where-url-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'url',
            'default' => '',
            'label' => __("What is the URL?", 'complianz-gdpr'),
            'condition' => array('security-protocol-where-uk' => '2'),
        ),
        'processing-security-measures-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'multicheckbox',
            'default' => '',
            'label' => __("Select the required security standard or measure.", 'complianz-gdpr'),
            'condition' => array('security_measures-uk' => '3'),
            'options' => array(
	            '1' => __('Username and Password', 'complianz-gdpr'),
	            '2' => __('DNSSEC', 'complianz-gdpr'),
	            '3' => __('TLS / SSL', 'complianz-gdpr'),
	            '4' => __('DKIM, SPF en DMARC', 'complianz-gdpr'),
	            '5' => __('Physical security measures of systems which contain personal  data.', 'complianz-gdpr'),
	            '6' => __('Security software', 'complianz-gdpr'),
	            '7' => __('ISO27001/27002 certified', 'complianz-gdpr'),
	            '8' => 'HTTP Strict Transport Security',
	            '9' => 'X-Content-Type-Options',
	            '10' => 'X-XSS-Protection',
	            '11' => 'X-Frame-Options',
	            // '12' => 'Expect-CT',
	            // '13' => 'No Referrer When Downgrade header',
	            '14' => 'Content Security Policy',
	            '15' => __('STARTTLS and DANE','complianz-gdpr'),
	            '16' => 'WPA2 Enterprise',
                '17' => __('Other:', 'complianz-gdpr'),
            ),
        ),
        'processing-security-measures-other-uk' => array(
            'step' => 2,
            'section' => 2,
            'source' => 'processing-uk',
            'type' => 'textarea',
            'default' => '',
            'label' => __("Other:", 'complianz-gdpr'),
            'condition' => array('processing-security-measures-uk' => '17'),
        ),
        // RIGHT OF AUDIT

        'when-audit-uk' => array(
            'step' => 2,
            'section' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("When can you, as the data controller, carry out audits?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('If similar reports give no or insufficient clarification.', 'complianz-gdpr'),
                '2' => __('With a reasonable suspicion of abuse,', 'complianz-gdpr'),
                '3' => __('Once every quarter and more often with reasonable suspicion of abuse.', 'complianz-gdpr'),
                '4' => __('Once every year and more often with reasonable suspicion of abuse.', 'complianz-gdpr'),
            ),
        ),

        'audit-uk' => array(
            'step' => 2,
            'section' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("Can the audit be carried out by an independent Third Party?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('The audit may be performed by an independent Third Party.', 'complianz-gdpr'),
                '2' => __('Only I can perform audits', 'complianz-gdpr'),
            ),
        ),


        'what-do-with-findings-uk' => array(
            'step' => 2,
            'section' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("What should be done with the findings of the audit?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('The processor is obliged to implement the findings as quickly as possible.', 'complianz-gdpr'),
                '2' => __('The parties should decide together what to do with these findings.', 'complianz-gdpr'),
            ),
        ),

        'audit-costs-uk' => array(
            'step' => 2,
            'section' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("Who is responsible for any audit costs?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('Data controller', 'complianz-gdpr'),
                '2' => __('Processor', 'complianz-gdpr'),
                '3' => __('The Processor, in case of non - trivial violations of the obligations from the processor agreement. Otherwise the data controller.', 'complianz-gdpr'),
            ),
        ),

        // DATA breach
        'when-informed-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("How quickly should the Data Controller be informed of a data breach?", 'complianz-gdpr'),
            'options' => array(
                '1' => __('Immediately (without unreasonable delay) after the leak has become known to the Processor.', 'complianz-gdpr'),
                '2' => __('Immediately (without unreasonable delay), within 24 hours after the leak has become known to the Processor.', 'complianz-gdpr'),
                '3' => __('Immediately (without unreasonable delay), within 36 hours after the leak has become known to the Processor.', 'complianz-gdpr'),
            ),
        ),
        'maximize-liability-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("Do you want to limit liability?", 'complianz-gdpr'),
            'options' => $this->yes_no,
        ),

        'amount-liable-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'text',
            'default' => '',
            'placeholder' => __('0.00 £','complianz-gdpr'),
            'condition' => array('maximize-liability-uk' =>'yes'),
            'required' => true,
            'label' => __("What is the maximum liability for violations of the processor agreement?", 'complianz-gdpr'),
        ),
        'insurance-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'label' => __("Should the Processor take out liability insurance?", 'complianz-gdpr'),
            'options' => $this->yes_no,
        ),
        'max_cost_of_insurance-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'text',
            'default' => '',
            'required' => true,
            'placeholder' => __('0.00 £','complianz-gdpr'),
            'label' => __("What is the minimum amount the insurance should cover?", 'complianz-gdpr'),
            'condition' => array('insurance-uk' => 'yes'),
        ),
        'insurance_conditions-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'multicheckbox',
            'default' => '',
            'required' => true,
            'condition' => array('insurance-uk' => 'yes'),
            'label' => __("The insurance conditions must provide at least cover for the following claims:", 'complianz-gdpr'),
            'options' => array(
                '1' => __('Data breaches.', 'complianz-gdpr'),
                '2' => __('Not complying to the processing data contract.', 'complianz-gdpr'),
            ),
        ),
        'access-to-policy-uk' => array(
            'step' => 3,
            'source' => 'processing-uk',
            'type' => 'radio',
            'default' => '',
            'required' => true,
            'condition' => array('insurance-uk' => 'yes'),
            'options' => $this->yes_no,
            'label' => __("Access to the insurance policy can be demanded.", 'complianz-gdpr'),
        ),
        'finish_setup_processing-uk' => array(
            'step' => '4',
            'source' => 'processing-uk',
            'callback' => 'processing_last_step',
        ),
    );
