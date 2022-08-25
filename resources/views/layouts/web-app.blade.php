description = "Landing page layout for esense"
==
<html lang="en">

    {% partial 'head' %}

    <link href="{{ [
        '/node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css',
        '/node_modules/@yaireo/tagify/dist/tagify.css',
        'assets/scss/esense/web-app/web-app.scss',
    ]|theme }}" rel="stylesheet">

    <body>

        {% flash %}
            <p
                data-control="flash-message"
                class="flash-message fade {{ type }}"
                data-interval="5">
                {{ message }}
            </p>
        {% endflash %}

        <div id="wrapper">
            <!-- Side navbar -->
            {% partial 'web-app/navs/side-nav' %}
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column" style="background: #F8F6F4";>
                <!-- Main Content -->
                <div id="content">
                    <!-- Top navbar -->
                    {% partial 'web-app/navs/top-nav' %}
                    <!-- Page content -->
                    {% page %}
                </div>
            </div>
        </div>

        <script defer src="{{ [
            '/node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js',
            '/node_modules/owl.carousel/dist/owl.carousel.min.js',
            '/node_modules/datatables.net/js/jquery.dataTables.js',
            '/node_modules/@yaireo/tagify/dist/tagify.min.js',
            '/node_modules/chart.js/dist/Chart.js',
            'assets/js/text-inside-donut-chart.js',
            'assets/js/dashboard-nav.js',
            'assets/js/jquery.richtext.min.js',
            'assets/js/owl-students-activity.js',
            'assets/js/owl-exercises.js',
            'assets/js/owl-exercise-details.js',
            'assets/js/calendar.js',
            'assets/js/ajax-setup.js',
            ]|theme }}">
        </script>

        {% framework extras %}
        {% scripts %}
    </body>

</html>
