<?php

/**
 * Template Name:Sign-up
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<main>
    <section class="sec-signin">
        <div class="container">
            <div class="sip-main">
                <div class="sip-left">
                    <h2>Enter your mobile number below to sign up for the best coupons, discount codes, and opportunities to receive free samples from various brands</h2>

                    <form class="signup-form" id="signupForm">
                        <div class="form-group">
                            <input type="text" id="fullname" name="fullname" placeholder="Full Name*">
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" placeholder="Phone Number*">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email Address*">
                        </div>
                        <div class="consent">
                            <p>Consent<span>*</span></p>
                        </div>
                        <div class="form-group consent">
                            <input type="checkbox" id="consent" name="consent">
                            <label for="consent">By checking this box, I provide my signature expressly consenting to receive daily text alerts regarding samples and coupons from The Samples Network at the cellular telephone number I have provided above. Message and data rates may apply. Message frequency varies. Reply STOP to any message to opt-out. Text HELP to 37508 for help. I agree that I am a U.S. resident and I agree to the <a href="javascriptvoid(0)">Privacy Policy </a>and <a href="javascriptvoid(0)">Terms and Conditions</a> </label>
                        </div>
                        <p class="btn-main sip-btn">
                            <button type="submit" class="btn">
                                <span>Sign Up</span>
                                <img src="<?php echo bloginfo('template_directory'); ?>/assets/icons/ArrowRight.svg">
                            </button>
                        </p>
                    </form>
                </div>
                <div class="sip-right">
                    <img src="<?php echo bloginfo('template_directory'); ?>/assets/images/sign-in.webp" alt="Sign In Image">
                </div>
            </div>
        </div>
    </section>

</main>
<?php
get_footer();
