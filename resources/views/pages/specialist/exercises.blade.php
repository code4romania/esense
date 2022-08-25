title = "Exerciții"
url = "/specialist/exercises/:category?"
layout = "web-app"
description = "Displays exercises list"
is_hidden = 0

[records]
activeOnly = 0
areaSlug = "exercises"
categorySlug = "{{ :category }}"
useMainCategory = 0
useMultiCategories = 1
tagSlug = "{{ :tag }}"
recordPage = "specialist/exercise"
recordPageSlug = "{{ :slug }}"
limit = 10
pageSlug = "{{ :page }}"
orderBy = "name"
orderByDirection = "ASC"

[categories]
activeOnly = 0
rootOnly = 0
parentCategorySlug = "jocuri"
areaSlug = "exercises"
activeRecordsOnly = 1
useMainCategory = 1
useMultiCategories = 1
categoriesPage = "specialist/exercises"
categoriesPageSlug = "{{ :category }}"
categoryPage = "specialist/exercises"
categoryPageSlug = "{{ :category }}"
limit = 10

[categoryDetail category]
activeOnly = 1
categorySlug = "jocuri"
areaSlug = "exercises"
recordPage = "specialist/exercise"
recordPageSlug = "{{ :slug }}"

[session]
security = "user"
allowedUserGroups[] = "registered"
allowedUserTypes[] = "specialist"
==
<div class="container-fluid px-lg-4 mb-5">
    <div class="row">
        <div class="col-12 col-md-6">
            <p class="text-gray-dark mt-3 font-weight-bold" style="line-height: 25px;">{{'page.specialist.dashboard.exercises.select.label'|_}}</p>
            <div class="form-group register-select mb-5 exercises-select" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <select class="form-control border outline-none selectpicker" data-style="btn-white" onchange="location = this.value;">
                <option value="{{categories.property('categoriesPage') ? categories.property('categoriesPage')|page({(categories.paramName('categoriesPageSlug')):(category.slug)})}}">{{'page.specialist.dashboard.exercises.select.all.option'|_}}</option>
                {% for category in categoryDetail.getChildren() %}
                    <option value="{{categories.property('categoriesPage') ? categories.property('categoriesPage')|page({(categories.paramName('categoriesPageSlug')):(category.slug)})}}" {{ category.slug == categories.property('categoriesPageSlug') ? 'selected'}}>
                        {{ category.name }}
                    </option>
                {% endfor %}
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        {% for record in records.items %}
            <div class="col-12 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <p class="p-0 m-0 text-gray-dark">{{record.name}}</p>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{ record.preview_image.getPath }}">
                        <p class="text-muted small pt-2">{{record.description|raw}}</p>
                    </div>
                    <div class="card-footer bg-white d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img class="img-fluid" src="{{ 'assets/img/svg/dashboard/exercise/label.svg'|theme }}">
                            <p class="p-0 m-0 ml-2" style="font-size: 12px; color: #000000; line-height:16px;">
                                {% for category in record.categories %}
                                    {{ category.name }}
                                {% endfor %}
                            </p>
                        </div>
                        <div>
                            <a href="{{records.property('recordPage') ? records.property('recordPage')|page({(records.paramName('recordPageSlug')):(record.slug)})}}" class="btn btn-sm btn-primary-dark">{{'page.specialist.dashboard.exercise.card.btn.text'|_}}</a>
                        </div>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
</div>
