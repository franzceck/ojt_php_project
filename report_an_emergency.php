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
    
<div class="container">
    <div class="card w-50 mx-auto mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Emergency Report Information</h5>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="bg-light p-4">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Full Name" name="full_name" required/>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" required/>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Location of the Incident" name="location" required/>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="emergency_type" required>
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
                    <label class="form-label">Request Assistance:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Wheel Chair" name="assistance[]">
                        <label class="form-check-label" for="inlineCheckbox1">Wheel Chair</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Ambulance" name="assistance[]">
                        <label class="form-check-label" for="inlineCheckbox2">Ambulance</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Firetruck" name="assistance[]">
                        <label class="form-check-label" for="inlineCheckbox3">Firetruck</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Stretcher" name="assistance[]">
                        <label class="form-check-label" for="inlineCheckbox4">Stretcher</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="Medical Assistance" name="assistance[]">
                        <label class="form-check-label" for="inlineCheckbox5">Medical Assistance</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="First Aid Kit" name="assistance[]">
                        <label class="form-check-label" for="inlineCheckbox6">First Aid Kit</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="customFile">Photo of the Incident</label>
                        <input type="file" class="form-control" id="customFile" name="photo" />
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
