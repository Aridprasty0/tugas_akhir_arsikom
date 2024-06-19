    <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>A108 Adam Street, NY 535022, USA</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@example.com</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container">
        <div class="form">
          <form action="kontak_proses.php" method="post" role="form">
            <div class="form-row">
              <div class="form-group col-md-6">

                <input type="text" name="nama" class="form-control" id="name" placeholder="Nama"  required="" />
                <div class="validation"></div>

              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="" />
                <div class="validation"></div>
              </div>
            </div>

            <div class="form-group">
              <textarea class="form-control" name="pesan" rows="3" placeholder="Pesan"></textarea>
              <div class="validation"></div>
            </div>
             <div class="text-center">
            <input type="submit" name="tambah" value="Kirim" class="btn btn-primary">
          </div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->