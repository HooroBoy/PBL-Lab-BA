<?php
session_start();
$title = 'Edit Site Setting';
include "../../public/layouts-admin/header-admin.php";
include "../../app/controllers/SiteSettingController.php";

$setting = SiteSettingController::get();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id' => $setting['id'],
        'landing_badge' => $_POST['landing_badge'],
        'landing_title' => $_POST['landing_title'],
        'landing_description' => $_POST['landing_description'],
        'landing_hero_image' => $_POST['landing_hero_image'],
        'footer_box_title' => $_POST['footer_box_title'],
        'footer_email' => $_POST['footer_email'],
        'footer_phone' => $_POST['footer_phone'],
        'footer_address' => $_POST['footer_address'],
        'social_linkedin' => $_POST['social_linkedin'],
        'social_instagram' => $_POST['social_instagram'],
        'social_youtube' => $_POST['social_youtube'],
        'footer_copyright_text' => $_POST['footer_copyright_text'],
    ];
    SiteSettingController::update($data);
    $setting = SiteSettingController::get();
    $message = "<script>Swal.fire({title: 'Berhasil', text: 'Site setting berhasil diupdate!', icon: 'success', showConfirmButton: false, timer: 2000, timerProgressBar: true,}).then(() => {window.location.href = 'edit.php';})</script>";
}
?>
<body>
    <script src="../../public/assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <div id="main" class="layout-navbar navbar-fixed">
            <?php require("../../public/layouts-admin/header.php") ?>
            <div id="main-content">
                <div class="container py-2">
                    <div class="page-heading mb-2">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3 class="mb-1">Site Setting</h3>
                                    <p class="text-subtitle text-muted mb-1">Edit Landing Page & Footer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm mb-4 w-100">
                                <div class="card-body">
                                    <?php if (!empty($message)) echo $message; ?>
                                    <form method="post">
                                        <h5 class="mb-3">Landing Page</h5>
                                        <div class="mb-3">
                                            <label class="form-label">Badge</label>
                                            <input type="text" name="landing_badge" class="form-control" value="<?php echo htmlspecialchars($setting['landing_badge']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="landing_title" class="form-control" value="<?php echo htmlspecialchars($setting['landing_title']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="landing_description" class="form-control"><?php echo htmlspecialchars($setting['landing_description']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Hero Image URL</label>
                                            <input type="text" name="landing_hero_image" class="form-control" value="<?php echo htmlspecialchars($setting['landing_hero_image']); ?>">
                                        </div>
                                        <hr>
                                        <h5 class="mb-3">Footer</h5>
                                        <div class="mb-3">
                                            <label class="form-label">Footer Box Title</label>
                                            <input type="text" name="footer_box_title" class="form-control" value="<?php echo htmlspecialchars($setting['footer_box_title']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Footer Email</label>
                                            <input type="text" name="footer_email" class="form-control" value="<?php echo htmlspecialchars($setting['footer_email']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Footer Phone</label>
                                            <input type="text" name="footer_phone" class="form-control" value="<?php echo htmlspecialchars($setting['footer_phone']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Footer Address</label>
                                            <textarea name="footer_address" class="form-control"><?php echo htmlspecialchars($setting['footer_address']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">LinkedIn</label>
                                            <input type="text" name="social_linkedin" class="form-control" value="<?php echo htmlspecialchars($setting['social_linkedin']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="social_instagram" class="form-control" value="<?php echo htmlspecialchars($setting['social_instagram']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">YouTube</label>
                                            <input type="text" name="social_youtube" class="form-control" value="<?php echo htmlspecialchars($setting['social_youtube']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Footer Copyright</label>
                                            <input type="text" name="footer_copyright_text" class="form-control" value="<?php echo htmlspecialchars($setting['footer_copyright_text']); ?>">
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require("../../public/layouts-admin/footer.php") ?>
        </div>
    </div>
    <script src="../../public/assets/static/js/components/dark.js"></script>
    <script src="../../public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../public/assets/compiled/js/app.js"></script>
    <script src="../../public/assets/static/js/pages/sweetalert2.js"></script>
</body>
</html>
