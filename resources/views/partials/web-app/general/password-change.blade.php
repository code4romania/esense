description = "Partial for password change"

[viewBag]
==
<!-- Modal -->
<div class="modal fade" id="changePasswodTeacherModal" tabindex="-1" role="dialog" aria-labelledby="changePasswodTeacherModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" data-request="onPasswordUpdate">
                <div class="row p-5">
                    <div class="col-12">
                        <p class="text-center py-3">{{'partial.general.change.password.title'|_}}</p>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3 px-lg-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-light" id="current-password-addon">
                                    <img class="img-fluid" src="{{ 'assets/img/svg/password-icon.svg'|theme }}" alt="Emblemă lacăt pentru parola actuală">
                                </span>
                            </div>
                            <!-- Current password input -->
                            <input type="password" name="current_password" class="form-control border-left-0 border-light pl-0" placeholder="{{'partial.general.change.current.password'|_}}" aria-label="password" aria-describedby="current-password-addon">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3 px-lg-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-light" id="password-addon">
                                    <img class="img-fluid" src="{{ 'assets/img/svg/password-icon.svg'|theme }}" alt="Emblemă lacăt pentru parola dorită">
                                </span>
                            </div>
                            <!-- Password input -->
                            <input type="password" name="password" class="form-control border-left-0 border-light pl-0" placeholder="{{'partial.general.new.password.placeholder'|_}}" aria-label="password" aria-describedby="password-addon">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3 px-lg-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-light" id="password-confirmation-addon">
                                    <img class="img-fluid" src="{{ 'assets/img/svg/password-icon.svg'|theme }}" alt="Emblemă lacăt pentru confirmare parola dorită">
                                </span>
                            </div>
                            <!-- Password confirmation input -->
                            <input type="password" name="password_confirmation" class="form-control border-left-0 border-light pl-0" placeholder="{{'partial.general.password.confirmation.placeholder'|_}}" aria-label="resest-password" aria-describedby="password-confirmation-addon">
                        </div>
                    </div>

                    <div class="col-12 mt-">
                        <!-- Submit button -->
                        <div class="d-flex align-items-center justify-content-end mt-3 mb-3">
                            <a role="button" class="mr-3 text-gray-2 display-4" data-dismiss="modal">{{'partial.general.change.password.cancel.btn'|_}}</a>
                            <button type="submit" class="btn btn-sm px-5 btn-secondary">{{'partial.general.change.password.change.btn'|_}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
