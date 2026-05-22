/**
*
* -----------------------------------------------------------------------------
*
* Template JS for Admin*
* -----------------------------------------------------------------------------
*
**/

(function($) {

	"use strict";
	 $('.radio-select label').on('click', function(event) {   
	    $('.radio-select label').removeClass('active');
	    $(this).addClass('active');	      
	});

	$('#meta-image-button').on('click', function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    wp.media.editor.send.attachment = function(props, attachment) {
	        $('#meta-image').val(attachment.url);
	 		 $('#meta-image-preview').attr('src',attachment.url);
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();
	    return false;
	});
	
	$(".meta-img-wrap i").on('click', function(){
		$('.meta-img-wrap').hide();
	    $("#meta-image").val('');
	});

	// ========================================
	// autovault Admin Panel JavaScript
	// ========================================

	// Media Uploader for Logo and Favicon
	var mediaUploader;

	// Logo Upload
	$(document).on('click', '.upload-logo-button', function(e) {
		e.preventDefault();
		
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media({
			title: autovault_admin.strings.select_image || 'Select Logo',
			button: {
				text: autovault_admin.strings.use_image || 'Use This Logo'
			},
			multiple: false,
			library: {
				type: 'image'
			}
		});

		mediaUploader.on('select', function() {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#site_logo').val(attachment.url);
			$('.logo-preview').html('<img src="' + attachment.url + '" alt="Logo Preview">');
			$('.remove-logo-button').show();
		});

		mediaUploader.open();
	});

	// Remove Logo
	$(document).on('click', '.remove-logo-button', function(e) {
		e.preventDefault();
		$('#site_logo').val('');
		$('.logo-preview').html('<div class="no-logo">' + (autovault_admin.strings.no_logo || 'No logo selected') + '</div>');
		$(this).hide();
	});

	// Favicon Upload
	$(document).on('click', '.upload-favicon-button', function(e) {
		e.preventDefault();
		
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media({
			title: autovault_admin.strings.select_favicon || 'Select Favicon',
			button: {
				text: autovault_admin.strings.use_favicon || 'Use This Favicon'
			},
			multiple: false,
			library: {
				type: 'image'
			}
		});

		mediaUploader.on('select', function() {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#favicon').val(attachment.url);
			$('.favicon-preview').html('<img src="' + attachment.url + '" alt="Favicon Preview">');
			$('.remove-favicon-button').show();
		});

		mediaUploader.open();
	});

	// Remove Favicon
	$(document).on('click', '.remove-favicon-button', function(e) {
		e.preventDefault();
		$('#favicon').val('');
		$('.favicon-preview').html('<div class="no-favicon">' + (autovault_admin.strings.no_favicon || 'No favicon selected') + '</div>');
		$(this).hide();
	});

	// Theme Options Form Submission
	$(document).on('submit', '#autovault-theme-options-form', function(e) {
		e.preventDefault();
		
		var $form = $(this);
		var $submitBtn = $form.find('button[type="submit"]');
		var $status = $('.save-status .save-message');
		var $originalText = $submitBtn.html();
		
		// Show loading state
		$submitBtn.prop('disabled', true).html('<span class="dashicons dashicons-update"></span> ' + autovault_admin.strings.saving);
		$status.removeClass('success error').text('');
		
		// Collect form data
		var formData = new FormData();
		formData.append('action', 'autovault_save_settings');
		formData.append('nonce', $('#autovault_nonce').val());
		
		// Add all form fields
		$form.find('input, select, textarea').each(function() {
			var $field = $(this);
			var name = $field.attr('name');
			var value = $field.val();
			
			if (name) {
				if ($field.attr('type') === 'checkbox') {
					formData.append('settings[' + name + ']', $field.is(':checked') ? '1' : '0');
				} else {
					formData.append('settings[' + name + ']', value);
				}
			}
		});
		
		// Send AJAX request
		$.ajax({
			url: autovault_admin.ajax_url,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				if (response.success) {
					$status.addClass('success').text(autovault_admin.strings.saved);
					
					// Show success message for 3 seconds
					setTimeout(function() {
						$status.removeClass('success').text('');
					}, 3000);
				} else {
					throw new Error(response.data || autovault_admin.strings.error);
				}
			},
			error: function(xhr, status, error) {
				$status.addClass('error').text(autovault_admin.strings.error);
			},
			complete: function() {
				// Reset button state
				$submitBtn.prop('disabled', false).html($originalText);
			}
		});
	});

	// Reset Settings
	$(document).on('click', '.reset-settings', function(e) {
		e.preventDefault();
		
		if (!confirm(autovault_admin.strings.reset_confirm || 'Are you sure you want to reset all settings to default values?')) {
			return;
		}
		
		var $status = $('.save-status .save-message');
		
		// Reset all form fields to default values
		$('#autovault-theme-options-form')[0].reset();
		
		// Clear logo and favicon
		$('#site_logo, #favicon').val('');
		$('.logo-preview, .favicon-preview').html('<div class="no-logo">' + (autovault_admin.strings.no_image || 'No image selected') + '</div>');
		$('.remove-logo-button, .remove-favicon-button').hide();
		
		$status.addClass('success').text(autovault_admin.strings.reset_success || 'Settings reset to default values');
		
		// Clear message after 3 seconds
		setTimeout(function() {
			$status.removeClass('success').text('');
		}, 3000);
	});

	// FAQ Toggle Functionality
	$(document).on('click', '.faq-question', function() {
		var $faqItem = $(this).parent();
		var $answer = $faqItem.find('.faq-answer');
		
		// Close other FAQ items
		$('.faq-item').not($faqItem).removeClass('active');
		
		// Toggle current FAQ item
		$faqItem.toggleClass('active');
	});

	// Initialize FAQ items (close all by default)
	$('.faq-item').removeClass('active');

	// Smooth scrolling for anchor links
	$(document).on('click', 'a[href^="#"]', function(e) {
		var target = $(this.getAttribute('href'));
		if (target.length) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: target.offset().top - 100
			}, 500);
		}
	});

	// Tab switching animation
	$(document).on('click', '.nav-tab', function(e) {
		var $tab = $(this);
		if (!$tab.hasClass('nav-tab-active')) {
			$('.nav-tab').removeClass('nav-tab-active');
			$tab.addClass('nav-tab-active');
			
			// Add loading animation to content area
			$('.autovault-admin-content').addClass('loading');
			
			setTimeout(function() {
				$('.autovault-admin-content').removeClass('loading');
			}, 300);
		}
	});

	// Initialize tooltips for help text
	$(document).ready(function() {
		// Add tooltip functionality if needed
		$('[data-tooltip]').each(function() {
			var $element = $(this);
			var tooltipText = $element.data('tooltip');
			
			$element.on('mouseenter', function() {
				// Create tooltip
				var $tooltip = $('<div class="autovault-tooltip">' + tooltipText + '</div>');
				$('body').append($tooltip);
				
				// Position tooltip
				var offset = $element.offset();
				$tooltip.css({
					top: offset.top - $tooltip.outerHeight() - 5,
					left: offset.left + ($element.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
				});
			});
			
			$element.on('mouseleave', function() {
				$('.autovault-tooltip').remove();
			});
		});
	});

	// Form validation
	function validateForm() {
		var isValid = true;
		var $form = $('#autovault-theme-options-form');
		
		// Check required fields
		$form.find('[required]').each(function() {
			var $field = $(this);
			if (!$field.val().trim()) {
				$field.addClass('error');
				isValid = false;
			} else {
				$field.removeClass('error');
			}
		});
		
		// Email validation
		$form.find('input[type="email"]').each(function() {
			var $field = $(this);
			var email = $field.val();
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			
			if (email && !emailRegex.test(email)) {
				$field.addClass('error');
				isValid = false;
			} else {
				$field.removeClass('error');
			}
		});
		
		// URL validation
		$form.find('input[type="url"]').each(function() {
			var $field = $(this);
			var url = $field.val();
			
			if (url && !isValidUrl(url)) {
				$field.addClass('error');
				isValid = false;
			} else {
				$field.removeClass('error');
			}
		});
		
		return isValid;
	}

	function isValidUrl(string) {
		try {
			new URL(string);
			return true;
		} catch (_) {
			return false;
		}
	}

	// Real-time form validation
	$(document).on('blur', 'input[required], input[type="email"], input[type="url"]', function() {
		validateForm();
	});

	// Clear error states on input
	$(document).on('input', '.error', function() {
		$(this).removeClass('error');
	});

	// Add loading class to admin content
	$('.autovault-admin-content').on('DOMSubtreeModified', function() {
		$(this).removeClass('loading');
	});

})(jQuery);