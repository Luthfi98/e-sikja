# Create a web client object
$webClient = New-Object System.Net.WebClient

# Download jQuery
$webClient.DownloadFile("https://code.jquery.com/jquery-3.7.1.min.js", "public\assets\vendor\jquery\jquery.min.js")

# Download Bootstrap
$webClient.DownloadFile("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css", "public\assets\vendor\bootstrap\css\bootstrap.min.css")
$webClient.DownloadFile("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js", "public\assets\vendor\bootstrap\js\bootstrap.min.js")

# Download Font Awesome
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css", "public\assets\vendor\fontawesome\css\all.min.css")
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2", "public\assets\vendor\fontawesome\webfonts\fa-solid-900.woff2")
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.ttf", "public\assets\vendor\fontawesome\webfonts\fa-solid-900.ttf")
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-regular-400.woff2", "public\assets\vendor\fontawesome\webfonts\fa-regular-400.woff2")
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-regular-400.ttf", "public\assets\vendor\fontawesome\webfonts\fa-regular-400.ttf")
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.woff2", "public\assets\vendor\fontawesome\webfonts\fa-brands-400.woff2")
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.ttf", "public\assets\vendor\fontawesome\webfonts\fa-brands-400.ttf")

# Download DataTables
$webClient.DownloadFile("https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css", "public\assets\vendor\datatables\css\dataTables.bootstrap5.min.css")
$webClient.DownloadFile("https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css", "public\assets\vendor\datatables\css\responsive.bootstrap5.min.css")
$webClient.DownloadFile("https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js", "public\assets\vendor\datatables\js\jquery.dataTables.min.js")
$webClient.DownloadFile("https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js", "public\assets\vendor\datatables\js\dataTables.bootstrap5.min.js")
$webClient.DownloadFile("https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js", "public\assets\vendor\datatables\js\dataTables.responsive.min.js")
$webClient.DownloadFile("https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js", "public\assets\vendor\datatables\js\responsive.bootstrap5.min.js")

# Download SweetAlert2
$webClient.DownloadFile("https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css", "public\assets\vendor\sweetalert2\sweetalert2.min.css")
$webClient.DownloadFile("https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js", "public\assets\vendor\sweetalert2\sweetalert2.all.min.js")

# Download Popper.js
$webClient.DownloadFile("https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js", "public\assets\vendor\popper\popper.min.js")

# Download Moment.js
$webClient.DownloadFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js", "public\assets\vendor\moment\moment.min.js")

# Download CKEditor
$webClient.DownloadFile("https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js", "public\assets\vendor\ckeditor\ckeditor.js")

Write-Host "All assets have been downloaded successfully!" 