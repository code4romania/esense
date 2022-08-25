[viewBag]

[linkList]
linkedin = 1
facebook = 1
youtube = 1
linkTarget = "_blank"
==
<section>
    <div class="container-fluid bg-secondary2 pb-3">
        <div class="row">
            <div class="col-12">
                <div>
                    {% set links = linkList.links %}
                    {% if links | length %}
                        <ul class="d-flex align-items-center justify-content-center footer-icons">
                            {% for link in links %}
                                <li class="d-flex align-items-center justify-content-center">
                                    <a class="" target="_blank" href="{{ link.getLink }}" title="{{ link.getName }}">
                                        <i class="small text-white {{ link.getIcon }}"></i>
                                    </a>
                                </li>
                            {% endfor %}
                        </ul>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</section>
