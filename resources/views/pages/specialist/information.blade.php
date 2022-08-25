title = "Informații utile"
url = "/specialist/information/:slug?"
layout = "web-app"
description = "Displays platform informations"
is_hidden = 0

[recordDetail]
activeOnly = 0
recordSlug = "{{ :slug }}"
areaSlug = "informations"
categorySlug = "{{ :category }}"
useMainCategory = 1
useMultiCategories = 1
categoryPage = "category"
categoryPageSlug = "{{ :category }}"

[categoryDetail category]
activeOnly = 1
categorySlug = "introducere-in-platforma"
areaSlug = "informations"
recordPage = "specialist/information"
recordPageSlug = "{{ :slug }}"

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "specialist"
==
<?php
function onEnd()
{
    if(!$this['recordDetail']){
        $this['recordDetail'] = $this['categoryDetail']->records[0];
    }
}
?>
==
<div class="container-fluid px-lg-4 mb-5 min-vh-100">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-7">
            {% if recordDetail.preview_image %}
                <div>
                    <img class="img-fluid w-100" src="{{ recordDetail.preview_image.getPath }}">
                </div>
            {% endif %}
            <h5 class="text-medium-dark py-3">
                {{recordDetail.description|raw}}
            </h5>
            <div class="text-medium-dark">
                {{recordDetail.content|raw}}
            </div>
        </div>
        <div class="col-12 col-lg-4 mt-lg-5">
			<ul class="timeline">
                {% for record in categoryDetail.records %}
                    <li class="{{ (record.slug == recordDetail.slug) ? ('active') : ('') }}">
                        <a class="text-medium-dark" style="line-height: 25px;" href="{{ (category.property('recordPage')) ? category.property('recordPage')|page({(category.paramName('recordPageSlug')):(record.slug)})}}">{{ record.name }}</a>
                    </li>
                {% endfor %}
			</ul>
		</div>
    </div>
</div>
