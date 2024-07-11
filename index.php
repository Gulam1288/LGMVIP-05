<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SRMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(90deg, rgb(43, 77, 130), rgb(40, 144, 172));
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            color: #ffffff;
        }

        .hero {
            background: url('https://png.pngtree.com/back_origin_pic/05/15/92/cc985bd8e43be30318a2252afea56534.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            width: 100%;
            padding: 100px 0;
            color: #000;
            text-align: center;
            background-attachment: fixed;
        }

        .about, .features, .contact, .faq {
            padding: 60px 0;
            text-align: center;
        }

        .feature {
            padding: 20px;
        }

        .faq p {
            text-align: left;
        }

        .contact-form {
            max-width: 600px;
            margin: 30px auto;
            text-align: left;
        }

        label {
            font-weight: bold;
            font-size: 1.1rem;
        }

                progress {
            position: fixed;
            top: 64px;
            left: 0;
            z-index: 111;
            width: 100%;
            height: 6px;
            border: none;
            background: transparent;
        }

        progress::-webkit-progress-bar {
            background: transparent;
        }

        progress::-webkit-progress-value {
            background: linear-gradient(90deg, rgb(160, 222, 219),rgb(3, 165, 209));
            background-attachment: fixed;
        }
        
        progress::-moz-progress-bar {
            background: linear-gradient(90deg, rgb(160, 222, 219),rgb(3, 165, 209));
            background-attachment: fixed;
        }

        footer {
            background-color: #212121;
            color: #ffffff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SRMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'view_results.php' ? 'active' : ''; ?>" href="view_results.php">Results</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>" href="register.php">Register</a>
                </li>
                <?php if (!isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="hero" id="hero">
    <div class="container">
        <h1 class="display-4">Welcome to SRMS</h1>
        <p class="lead">The best student results management system</p>
    </div>
</div>

<div class="about" id="about">
    <div class="container">
        <h2>About Us</h2>
        <p>SRMS is a comprehensive student results management system that helps schools and colleges to manage and track students' academic performance efficiently.</p>
    </div>
</div>

<div class="features" id="features">
    <div class="container">
        <h2>Features</h2>
        <div class="row" data-bs-theme="dark">
            <div>
                <div class="card feature bg-secondary">
                    <div class="card-body">
                        <h3 class="card-title">User-Friendly Interface</h3>
                        <p class="card-text">Our system is designed with a user-friendly interface, making it easy for anyone to use.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card feature bg-secondary">
                    <div class="card-body">
                        <h3 class="card-title">Secure</h3>
                        <p class="card-text">We prioritize the security of our users' data with advanced security measures.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card feature bg-secondary">
                    <div class="card-body">
                        <h3 class="card-title">Comprehensive Reports</h3>
                        <p class="card-text">Generate detailed reports on students' performance with just a few clicks.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="faq" id="faq">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion accordion-flush mt-5" id="faqAccordion" data-bs-theme="dark">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        How do I register for an account on SRMS?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>To register for an account on SRMS, click on the "Register" link in the navigation menu. You will be directed to a registration form where you need to provide your personal details such as name, email address, and create a password. Once you have filled out all the required fields, click on the "Submit" button. You will receive a confirmation email with a link to activate your account. After activation, you can log in to SRMS using your email and password.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        How can I view my academic results on SRMS?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>To view your academic results on SRMS, you need to log in to your account. Once logged in, navigate to the "Results" section from the navigation menu. Here, you will find a detailed report of your academic performance, including individual subject scores and overall grades. You can also download or print your results for future reference. If you encounter any issues, please contact support.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        What should I do if I forget my password?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>If you forget your password, click on the "Login" link in the navigation menu, and then click on the "Forgot Password?" link. You will be asked to enter your registered email address. A password reset link will be sent to your email. Follow the instructions in the email to reset your password. If you do not receive the email, check your spam folder or contact support for assistance.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                        How do I update my profile information?
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>To update your profile information, log in to your SRMS account and navigate to the "Profile" section. Here, you can update your personal details such as name, email address, and contact number. After making the necessary changes, click on the "Save" button to update your profile. If you need to update your academic information, please contact the administration.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                        Is my data secure on SRMS?
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Yes, your data is secure on SRMS. We use advanced security measures to protect your personal and academic information. Our system is designed with robust encryption protocols and secure servers to ensure that your data is safe from unauthorized access. Additionally, we regularly update our security features to combat emerging threats. If you have any concerns about data security, please contact our support team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="contact" class="contact section py-5">
    <div class="container">
      <h2 class="text-center">Contact Us</h2>
      <div class="row justify-content-center">
        <div id="alertPlaceholder"></div>
        <div class="col-md-8 contact-form">
            <form action="https://api.web3forms.com/submit" method="POST" id="form">
                <input type="hidden" name="access_key" value="d726d279-e178-4471-ab96-ffe7220e2847" />
                <input
                  type="hidden"
                  name="subject"
                  value="New Enquiry"
                />
                <input type="checkbox" name="botcheck" id="" style="display: none;" />
      
                <div class="form-group">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" name="Name" class="form-control" id="name" required>
                  </div>
                  <div class="form-group">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="text" name="Email" class="form-control" id="email" required>
                  </div>
                  <div class="form-group">
                    <label for="message" class="form-label mt-3">Message</label>
                    <textarea class="form-control" name="Message" id="message" required></textarea>
                  </div>
                <div class="mb-6">
                  <button
                    type="submit"
                    class="btn btn-warning mt-3"
                  >
                    Send Message
                  </button>
                </div>
              </form> 
        </div>
      </div>
    </div>
  </section>


<footer class="bg-dark text-white text-center py-3">
    &copy; 2024 SRMS. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
      // Fetch the form and alert placeholder
      const form = document.getElementById("form");
      const alertPlaceholder = document.getElementById('alertPlaceholder');

      form.addEventListener("submit", function (e) {
        e.preventDefault();
        
        if (!form.checkValidity()) {
          e.stopPropagation();
          form.classList.add('was-validated');
          return;
        }

        const formData = new FormData(form);
        const object = Object.fromEntries(formData);
        const json = JSON.stringify(object);

        fetch("https://api.web3forms.com/submit", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: json,
        })
        .then(async (response) => {
          let json = await response.json();
          if (response.status == 200) {
            showAlert(form);
          } else {
            // Submission failed
            console.log(response);
          }
        })
        .catch((error) => {
          console.log(error);
        })
        .then(function () {
          form.reset();
        });
      });

      function showAlert(form) {
        const alertHTML = `
          <div class="alert alert-success alert-dismissible fade show d-flex flex-column" role="alert">
            <span class="alert-message">Submitting...</span>
            <div class="progress mt-2">
              <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `;
        alertPlaceholder.innerHTML = alertHTML;

        // Animate the progress bar
        const progressBar = alertPlaceholder.querySelector('.progress-bar');
        const progressDiv = alertPlaceholder.querySelector('.progress');
        const alertMessage = alertPlaceholder.querySelector('.alert-message');
        let progress = 0;
        const interval = setInterval(() => {
          progress += 1;
          progressBar.style.width = `${progress}%`;
          progressBar.setAttribute('aria-valuenow', progress);
          if (progress >= 80 && progress < 100) {
            alertMessage.textContent = 'Almost done...';
          } else if (progress >= 100) {
            progressDiv.style.display = "none";
            alertMessage.textContent = 'Form Submitted successfully!';
            clearInterval(interval);
            setTimeout(() => {
              const alert = alertPlaceholder.querySelector('.alert');
              if (alert) {
                alert.classList.remove('show');
                setTimeout(() => {
                  alert.remove();
                }, 150); // Ensure the fade-out animation completes
              }
            }, 1200); // Show the final message for 1.2 second
          }
        }, 20); // Increase progress every 20ms for a total duration of 2 seconds
      }
    </script>
</body>
</html>
