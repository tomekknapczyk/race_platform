<div class="contact-container">
    <h3>Kontakt</h3>
    <div class="contact-box d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center justify-content-start">
            @if($first_contact)
                <div class="contact">
                    <strong>{{ $first_contact['name']->value }}</strong>
                    <a href="tel:{{ $first_contact['tel']->value }}">{{ $first_contact['tel']->value }}</a>
                </div>
            @endif

            @if($second_contact)
                <div class="contact">
                    <strong>{{ $second_contact['name']->value }}</strong>
                    <a href="tel:{{ $second_contact['tel']->value }}">{{ $second_contact['tel']->value }}</a>
                </div>
            @endif

            @if($email_contact)
                <div class="contact_email">
                    <strong>Napisz do nas:</strong>
                    <a href="mailto:{{ $email_contact->value }}">{{ $email_contact->value }}</a>
                </div>
            @endif
        </div>

        <div class="fb-page" data-href="https://www.facebook.com/RaceGcAtmRally" data-width="300" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/RaceGcAtmRally" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/RaceGcAtmRally">Rajdowy Puchar Śląska</a></blockquote></div>
    </div>
    <div class="copyright">
        Copyright 2018 <p class="craft text-white">Crafted by <a href="https://efabryka.net/" title="efabryka.net" alt="efabryka" target="_blank" rel="nofollow">efabryka.net</a></p>
    </div>
</div>