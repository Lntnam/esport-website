@lang('texts.subscription_confirmation_preview')

@lang('texts.email_greeting')

@lang('texts.subscription_confirmation_content')

@lang('texts.subscription_confirmation_footer')

@lang('texts.subscription_confirmation_goodbye')

{{ \Setting::get('physical-address') }}

Don't like these emails? Unsubscribe ( {!! $unsubscribeUrl !!} ).
