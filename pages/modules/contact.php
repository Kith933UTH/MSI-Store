<div class="contact-container">

    <!-- <button onclick="history.back()" class="go-back">
        <i class="fa-solid fa-caret-left"></i> Back
    </button> -->
    <div class="title">Get In Touch</div>
    <div class="description">Tell us how we can help you</div>
    <div class="main-contact">
        <div class="contact-form-wrapper">
            <?php if (isset($_POST['submit']) && $_POST['submit'] == "submit") { ?>
                <div class="thank-wrapper">
                    <p class="thank-item">
                        Thank you, <span><?php echo $_POST["cusName"] ?></span>, for contacting us.
                    </p>
                    <p class="thank-item">
                        We are very grateful and look forward to receiving more feedback from customers to further develop our services and serve you better.
                    </p>
                    <p class="thank-item">
                        We will contact you as soon as possible via email at <span><?php echo $_POST["cusMail"] ?></span> or by phone at <span><?php echo $_POST["cusTel"] ?></span>.
                    </p>
                    <div class="thank-sign">
                        <p>Best regards,</p>
                        <img src="./assets/img/sign.png" alt="sign">
                    </div>
                </div>
            <?php } else { ?>
                <form action="#" class="contact-form" method="POST">
                    <p>
                        <span>Hello MSI, my name is</span>
                        <input type="text" spellcheck="false" placeholder="your name here" name="cusName" required>.
                    </p>
                    <p class="col">
                        <span>I need to contact you about: </span>
                        <textarea spellcheck="false" placeholder="details of your problem" name="cusProblem" required></textarea>
                    </p>
                    <p class="col">
                        <span>Hope you respond to me via email</span>
                        <input type="email" spellcheck="false" placeholder="your email address" name="cusMail" required>
                    </p>
                    <p>
                        <span>or phone number</span>
                        <input type="tel" spellcheck="false" placeholder="your phone number" name="cusTel" required>.
                    </p>
                    <button type="submit" name="submit" value="submit">Send</button>
                </form>
            <?php } ?>
        </div>
        <div class="contact-infor">
            <div class="contact-infor-wrapper">
                <div class="contact-infor-tel">Hotline: <a href="tel:80-012-777">80 012 777</a></div>
                <div class="contact-infor-mail">Mail: <a href="mailto:contact.msi@gmail.com">contact.msi@gmail.com</a></div>
                <div class="contact-infor-address">Address: <a href="https://maps.app.goo.gl/cW5TjRFUrK3cXETH7" target="_blank">No. 69, Lide St, Zhonghe District, New Taipei City, Taiwan</a></div>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1549.8055975398295!2d121.48736170028037!3d25.0073819180911!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a82c71531cc7%3A0x6173619febf53ed9!2sMicro-Star%20International%20Co.%2C%20Ltd.!5e0!3m2!1sen!2s!4v1699801245981!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>