<?php

require 'connection.php';

$error = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $informant = isset($_POST['informant']) ? $_POST['informant'] : '';
    $mobile_number = isset($_POST['mobile_number']) ? $_POST['mobile_number'] : '';
    $location_of_the_incident = isset($_POST['location_of_the_incident']) ? $_POST['location_of_the_incident'] : '';
    $type_of_emergency = isset($_POST['type_of_emergency']) ? $_POST['type_of_emergency'] : '';
    $individual_name = isset($_POST['individual_name']) ? $_POST['individual_name'] : '';
    $request_assistance = isset($_POST['request_assistance']) ? implode(", ", $_POST['request_assistance']) : '';

    // Handle file upload
    if (isset($_FILES['photo_of_the_incident'])) {
        $file_name = $_FILES['photo_of_the_incident']['name'];
        $file_tmp = $_FILES['photo_of_the_incident']['tmp_name'];
        $file_type = $_FILES['photo_of_the_incident']['type'];
        $file_size = $_FILES['photo_of_the_incident']['size'];
        $file_error = $_FILES['photo_of_the_incident']['error'];

        if ($file_error === 0) {
            $file_destination = 'uploads/' . $file_name;
            if (move_uploaded_file($file_tmp, $file_destination)) {
                // Insert record into the database
                $sql = "INSERT INTO mss_emergency_reports (informant, mobile_number, location_of_the_incident, type_of_emergency, individual_name, request_assistance, photo_of_the_incident)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssssss", $informant, $mobile_number, $location_of_the_incident, $type_of_emergency, $individual_name, $request_assistance, $file_destination);
                if (mysqli_stmt_execute($stmt)) {
                  echo '<script>alert("Your Report Submitted Successfully");</script>';
                  echo '<script>window.location.href = window.location.href;</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $error = "Error moving uploaded file";
            }
        } else {
            $error = "Error uploading file";
        }
    } else {
        $error = "No file uploaded";
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Lifesaver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
</head>
<body>
    <section class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img class="logo" src="images/logo.png"/></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                      </li>
                    </ul>    
                  </div>
                </div>
              </nav>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="wrapper text-center">
                <h1>"SAVING LIVES IS NOT JUST A DUTY FOR US, BUT A LIFETIME COMMITMENT, WE ARE UNTV NEWS AND RESCUE"</h1>
                  <h3>- Kuya Daniel Razon</h3>
            
                  <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Report An Emergency</a>
            </div>
        </div>
    </section>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Emergency Report Information</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                <span style="color:red;"><?php echo $error; ?></span>
                  <form action="index.php" method="post" enctype="multipart/form-data" class="bg-light p-4.m-auto">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Full Name" name="informant" required/>
                        </div>
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" required/>
                        </div>
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Location of the Incident" name="location_of_the_incident" required/>
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="type_of_emergency" required>
                            <option value="" selected disabled>Type of Emergency:</option>
                            <option>Fire/Explosion</option>
                            <option>Injury/Illness</option>
                            <option>Safety and Security</option>
                            <option>Medical Emergency</option>
                            </select>
                        </div>
                        <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Name of the Individual" name="individual_name" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
    
                    </div>
                    <div class="col-md-12">
                        <label>Request Assistance:</label>
                        <br>
                            <div class="form-check form-check-inline d-flex m-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Wheel Chair" name="request_assistance[]">
                                <label class="form-check-label" for="inlineCheckbox1">Wheel Chair</label>
                            </div>
                            <div class="form-check form-check-inline d-flex m-3">
                             <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Ambulance" name="request_assistance[]">
                            <label class="form-check-label" for="inlineCheckbox2"> Ambulance</label>
                            </div>
                            <div class="form-check form-check-inline d-flex m-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Firetruck" name="request_assistance[]">
                                <label class="form-check-label" for="inlineCheckbox3">Firetruck</label>
                            </div>
                            <div class="form-check form-check-inline d-flex m-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Stretcher" name="request_assistance[]">
                                <label class="form-check-label" for="inlineCheckbox4">Stretcher</label>
                            </div>
                            <div class="form-check form-check-inline d-flex m-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="Medical Assistance" name="request_assistance[]">
                                <label class="form-check-label" for="inlineCheckbox5">Medical Assistance</label>
                            </div>
                            <div class="form-check form-check-inline d-flex m-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="First Aid Kit" name="request_assistance[]">
                                <label class="form-check-label" for="inlineCheckbox6">First Aid Kit</label>
                            </div>
                            <label class="form-label" for="customFile"><br>Photo of the Incident</label><input type="file" class="form-control" id="customFile" name="photo_of_the_incident" />
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

  

                </div>
            </div>
            </div>
            
        </div>
        </div>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/tmbb1.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="images/tmbb2.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="images/tmbb3.jpg" class="d-block w-100" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <section id="about" class="about section-padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
              <div class="about-img">
                <iframe
                  class="img-fluid"       
                  src="https://www.youtube.com/embed/hB79y9vYO0g?si=zFTTFp9Muv4FtKc_"
                  title="YouTube video player"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen>
                </iframe>
              </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md">
              <div class="about-text">
                <h2>
                  We are UNTV News and Rescue <br />Tulong Muna, Bago Balita
                </h2>
                <p class="about-p">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
                  eaque odit odio totam. Possimus reprehenderit quidem ad itaque
                  iure. Maiores officiis est reprehenderit corrupti, ad tenetur
                  tempora quasi sequi facilis dolore eaque dolor magnam laudantium
                  molestias consequuntur ipsa doloribus corporis quas et inventore
                  natus ratione! Alias consequatur odit fugit dolor.
                </p>
                <a href="#" class="btn btn-view-more btn-danger">View More</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="contact" class="contact section-padding">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-header text-center pb-5">
                <h2>Contact Us</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, eaque!</p>
              </div>
            </div>
          </div>
          <div class="row m-0">
            <div class="col-md-12 p-0 pt-4 pb-4">
              <form action="#" class="contact-bg p-4 m-auto">
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-3">
                      <input type="text" class="form-control" required placeholder="Full Name"/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <input type="email" class="form-control" required placeholder="Email Address"/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <textarea rows="3" class="form-control" required placeholder="Messages"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                      <button class="btn btn-lg btn-block btn-primary mt-3">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    <footer class="bg-dark p-2 text-center">
        <div class="container"></div>
        <p class="text-white">All Right Reserved @Livesaver</p>
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
