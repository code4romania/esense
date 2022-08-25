description = "Landing page layout for esense"
==
<html lang="en">

{% partial 'head' %}

<link href="{{ [
        'assets/scss/esense/landing-page/landing-page.scss',
    ]|theme }}" rel="stylesheet">

{% partial 'web-app/general/google-analytics' %}

<body>
    {% partial 'navbar' %}

    {% flash %}
        <p
            data-control="flash-message"
            class="flash-message fade {{ type }}"
            data-interval="5">
            {{ message }}
        </p>
    {% endflash %}

    {% page %}

    {% partial 'footer-columns' %}

    {% partial 'footer' %}

    {% partial 'footer-scripts' %}

</body>

</html>
