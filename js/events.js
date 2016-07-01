$(window).load(function () {
	$('.free_trial_form form input[type=submit]').on('click', function() {
    if (!window.__gaTracker) return;

    __gaTracker('send', {
      hitType: 'event',
      eventCategory: 'CTA',
      eventAction: 'Submit',
      eventLabel: 'SecureMail Trial Form',
      eventValue: 1
    });
	});

	$('#hsForm_9ea6629b-fa2c-40ff-8c19-94070e3b57d0 input[type=submit]').on('click', function() {
    if (!window.__gaTracker) return;

    __gaTracker('send', {
      hitType: 'event',
      eventCategory: 'Contact',
      eventAction: 'Submit',
      eventLabel: 'Contact Sales Submit',
      eventValue: 1
    });
	});

	$('#hsForm_c1666936-1dab-4d7d-b5f1-cbbf887ff268 input[type=submit]').on('click', function() {
    if (!window.__gaTracker) return;

    __gaTracker('send', {
      hitType: 'event',
      eventCategory: 'Contact',
      eventAction: 'Submit',
      eventLabel: 'General Contact Submit',
      eventValue: 1
    });
	});
});
