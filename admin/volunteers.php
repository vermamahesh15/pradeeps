<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Volunteer Management</h2>
    </div>

    <!-- Filters -->
    <div class="card mb-4 border-0 bg-light">
        <div class="card-body">
            <form id="volunteerFilterForm" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Search by Name">
                </div>
                <div class="col-md-3">
                    <input type="text" name="phone" class="form-control" placeholder="Mobile Number">
                </div>
                <div class="col-md-3">
                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter Records</button>
                </div>
            </form>
        </div>
    </div>

    <div id="volunteerListContainer" class="table-responsive">
        <!-- AJAX Content Loaded Here -->
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2">Loading volunteers...</p>
        </div>
    </div>
</div>

<!-- View/Edit Modal -->
<div class="modal fade" id="volunteerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div id="modalContent"></div>
        </div>
    </div>
</div>

<!-- ID Card Preview Modal -->
<div class="modal fade" id="idCardModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Volunteer ID Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center bg-light">
                <div id="idCardContainer"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="printIDCard()"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>

<style>
    .volunteer-photo-sm { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    .id-card-wrap {
        width: 320px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
        font-family: Arial, sans-serif;
    }
    .id-card-header {
        background: #0d6efd;
        color: white;
        padding: 15px;
    }
    .id-photo {
        width: 100px;
        height: 100px;
        border: 3px solid #fff;
        margin: -50px auto 10px;
        border-radius: 50%;
        background: #eee;
        object-fit: cover;
        position: relative;
    }
    .id-body { padding: 10px 20px 20px; }
    .id-name { font-weight: bold; font-size: 1.2rem; margin-bottom: 5px; color: #333; }
    .id-info { font-size: 0.85rem; color: #666; margin-bottom: 3px; }
    .id-barcode { background: #eee; padding: 5px; margin-top: 10px; font-size: 0.7rem; }
    
    @media print {
        /* Hide all content on the page */
        body * {
            visibility: hidden;
        }
        /* Only show the modal container and its contents */
        #idCardModal, #idCardModal * {
            visibility: visible;
        }
        /* Position the modal to the top-left of the physical page */
        #idCardModal {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .modal-header, .modal-footer, .btn-close {
            display: none !important;
        }
        .modal-content {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>

<script>
function printIDCard() {
    window.print();
}
</script>