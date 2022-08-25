title = "Exercițiu"
url = "/specialist/exercise/:slug"
layout = "web-app"
description = "Displays an exercise details"
is_hidden = 0

[recordDetail]
activeOnly = 0
recordSlug = "{{ :slug }}"
areaSlug = "exercises"
categorySlug = "{{ :category }}"
useMainCategory = 1
useMultiCategories = 1
categoryPage = "category"
categoryPageSlug = "{{ :category }}"

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "specialist"
==
<div class="container-fluid px-lg-4 mb-5">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-7">
            <img class="img-fluid w-100" src="{{ recordDetail.preview_image.getPath }}">
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <p class="text-gray-dark font-weight-bold">{{recordDetail.name}}</p>
            <div class="d-flex align-items-center mb-2">
                <img class="img-fluid" src="{{ 'assets/img/svg/small-tag-icon.svg'|theme }}">
                <p class="p-0 m-0 display-4 pl-3" style="color: #000;">{{recordDetail.category.name}}</p>
            </div>
            {% for tag in recordDetail.tags %}
                <p class="p-0 m-0 small text-primary-dark pb-1" style="letter-spacing: -0,3px; line-height:22px">{{ tag.name }}</p>
            {% endfor %}
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 mt-5 mb-3">
                    <p class="text-black font-weight-bold pb-2" style="line-height: 25px;">{{'page.specialist.dashboard.exercise.details.title'|_}}</p>
                    <!-- Exercises details owl carousel -->
                    <div class="col-12 mt-4">
                        <div class="exercise-detailes-owl-carousel owl-carousel owl-theme owl-responsive-0">
                            {% for image in recordDetail.images %}
                                <div class="item">
                                    <img class="img-fluid" src="{{image.getPath}}">
                                </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="small text-muted p-0 m-0 py-1" style="line-height:22px; letter-spacing: -0.3px;">{{recordDetail.content|raw}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
