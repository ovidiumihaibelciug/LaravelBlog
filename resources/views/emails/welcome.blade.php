@component('mail::message')
# Introduction

Thanks so much for registering!

@component('mail::button', ['url' => ''])
    Start Browsing
@endcomponent
@component('mail::panel', ['url' => ''])
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, voluptate. :)
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

