          <div id="layoutSidenav_nav">
              <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                  <div class="sb-sidenav-menu">
                      <div class="nav">
                          <div class="sb-sidenav-menu-heading">Core</div>
                          <a class="nav-link" href="<?= base_url() ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Dashboard
                          </a>
                          <div class="sb-sidenav-menu-heading">TRANSAKSI</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Penjualan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('jual') ?>">Transaksi</a>
                                    <a class="nav-link" href="/penjualan/laporan">Laporan</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Pembelian" aria-expanded="false" aria-controls="Pembelian">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Pembelian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Pembelian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('beli') ?>">Transaksi</a>
                                    <a class="nav-link" href="/pembelian/laporan">Laporan</a>
                                </nav>
                            </div>
                          <div class="sb-sidenav-menu-heading">MASTER</div>
                          <a class="nav-link" href="<?= base_url('service') ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                              Data Service
                          </a>
                          <?php if (session()->role == "Owner" || session()->role == "Manajer" || session()->role == "Admin") : ?>
                              <a class="nav-link" href="<?= base_url('/customer') ?>">
                                  <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                  Data Customer
                              </a>
                          <?php endif; ?>
                          <?php if (session()->role == "Owner" || session()->role == "Manajer" || session()->role == "Admin") : ?>
                              <a class="nav-link" href="<?= base_url('/supplier') ?>">
                                  <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                  Data Supplier
                              </a>
                          <?php endif; ?>
                          <?php if (session()->role == "Admin" || session()->role == "Owner") : ?>
                              <a class="nav-link" href="<?= base_url('/users') ?>">
                                  <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
                                  Data Users
                              </a>
                          <?php endif; ?>
                          <div class="sb-sidenav-footer">
                              <div class="small">Logged in as:</div>
                              Start Bootstrap
                          </div>
              </nav>
          </div>