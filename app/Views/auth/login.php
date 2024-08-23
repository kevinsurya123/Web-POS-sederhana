<?= $this->extend('auth/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login Toko Buku</h3>
                    </div>
                    <div class="card-body">
                        <!-- < ?= view('Myth\Auth\Views\_message_block') ?> -->
                        <form action="/login/auth" method="post">
                            <?= csrf_field() ?>

                            <!-- < ?php if ($config->validFields === ['email']) : ?> -->

                            <!-- < ?php else : ?> -->
                            <div class="form-floating mb-3">
                                <input class="form-control <?php if (session('msg')) : ?>is-invalid<?php endif ?>" name="email" placeholder="Email atau Username" type="text" />
                                <label for="inputEmail">Email atau Username</label>
                                <div class="invalid-feedback">
                                    <?= session('msg') ?>
                                </div>
                            </div>
                            <!-- < ?php endif; ?> -->


                            <div class="form-floating mb-3">
                                <input class="form-control  <?php if (session('msg')) : ?>is-invalid<?php endif ?>" name="password" type="password" placeholder="Password" />
                                <label for="inputPassword">Password</label>
                                <div class="invalid-feedback">
                                    <?= session('msg') ?>
                                </div>
                            </div>
                            <!-- < ?php if ($config->allowRemembering) : ?> -->
                            <!-- <div class="form-check mb-3">
                                    <input class="form-check-input" name="remember" type="checkbox" < ?php if (old('remember')) : ?> checked < ?php endif ?> />
                                    <label class="form-check-label" for="inputRememberPassword">< ?= lang('Auth.rememberMe') ?></label>
                                </div> -->
                            <!-- < ?php endif; ?> -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <!-- < ?php if ($config->activeResetter) : ?> -->
                                <!-- <a class="small" href="< ?= base_url() . route_to('forgot') ?>">< ?= lang('Auth.forgotYourPassword') ?></a> -->
                                <!-- < ?php endif; ?> -->
                            </div>
                            <!-- </div> -->
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <!-- < ?php if ($config->allowRegistration) : ?> -->
                        <!-- <div class="small">
                            <a href="login/register">Register</a>
                        </div> -->
                        <!-- < ?php endif; ?> -->
                    </div>
                </div>
                <div class="card-footer text-center py-3">
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?= $this->endSection() ?>