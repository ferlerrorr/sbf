jQuery(document).ready(function($) {
		        
    var LICENSE_SITE_URL = 'https://reactheme.com/products/license';

    // When the checkbox is clicked
    $('#is_envato_elements').on('change', function() {
        
        if($(this).is(':checked')) {
            $('#reacthemes-code-help-elements').css('display', 'block');
            $(this).val("on");
        } else {
            $('#reacthemes-code-help-elements').css('display', 'none');
            $(this).val("off");
        }
    });


    // When button is clicked
    $('#reacthemes-license-activator-form').on('submit', function(e) {

        e.preventDefault();
        var submit_type = $('#reacthemes-license-activator-form input#submit').attr('data-submit-type');
        var license_code = $('input[name="reacthemes_license_options[license_code]"]').val(); // Get the license code
        
        var is_envato_elements = $('input#is_envato_elements').val(); // Get the license code
        var url = LICENSE_SITE_URL + '/wp-json/reacthemes/v2/activate_license/?code=' + license_code + '&domain=' + domain;
        var license_activator = 'javascript';

        var bodyArgs = license_ajax_obj.license_data; // license data array
            bodyArgs.code = license_code;
            bodyArgs.is_envato_elements = is_envato_elements;
            bodyArgs.license_activator = license_activator;
            
        var domain = bodyArgs.domain;
        
        if(submit_type == 'activation'){
            // Send POST request using fetch
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(bodyArgs)
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {

            
                    // Now send the WordPress AJAX request if the fetch is successful
                        
                    let status = JSON.parse(JSON.stringify(data));
                    
                    if(status && status == 'success' ||  status == 'updated'){
                        $.ajax({
                            url: license_ajax_obj.ajax_url, // WordPress AJAX URL
                            method: 'POST',
                            data: {
                                action: 'activate_license', // WordPress action
                                license_code: license_code,
                                domain: domain,
                                is_envato_elements: is_envato_elements,
                                nonce: license_ajax_obj.nonce, // Security nonce
                                status: status
                            },
                            success: function(response) {
                                // Handle the response from the server
                                
                                if (response.success) {
                                    // Show success message from WordPress
                                    alert(response.data.message);
                                    location.reload();
                                   
                                } else {
                                    // Show error message from WordPress
                                    // console.log('ajax response', response);
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle errors from the AJAX request
                                alert('This license cant be activated. Enter valid license and try again. If still not working, please contact theme support.')
                            }
                        });
                    }else if(status == 'existng'){
                        alert('Already activated this license!')
                    }else{
                        alert('This license cant be activated. Enter valid license and try again. If still not working, please contact theme support.')
                    }
                    
                    
                    
            
            })
            .catch(error => {
                alert('This license cant be activated. Enter valid license and try again. If still not working, please contact theme support.')
            });
        }

        if(submit_type == 'deactivation'){

            url = LICENSE_SITE_URL + '/wp-json/reacthemes/v2/remove_license_domain_by_user/?code=' + license_code + '&domain=' + domain;
            // Send POST request using fetch
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(bodyArgs)
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                
                    // Now send the WordPress AJAX request if the fetch is successful
                        
                    let status = JSON.parse(JSON.stringify(data));
                    
                    if(status == 200){
                        $.ajax({
                            url: license_ajax_obj.ajax_url, // WordPress AJAX URL
                            method: 'POST',
                            data: {
                                action: 'remove_license', // WordPress action
                                nonce: license_ajax_obj.nonce, // Security nonce
                            },
                            success: function(response) {
                                // Handle the response from the server
                                
                                if (response.success) {
                                    // Show success message from WordPress
                                    alert(response.data.message);
                                    location.reload();
                                   
                                } else {
                                    // Show error message from WordPress
                                    // console.log('ajax response', response);
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle errors from the AJAX request
                                alert('This license cant be removed. Please contact theme support.')
                            }
                        });
                    }
                    
            })
            .catch(error => {
                alert('This license cant be removed. Please contact theme support.')
            });
        }

        
    });
		        
});