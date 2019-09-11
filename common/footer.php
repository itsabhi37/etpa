<!-- Sticky Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Designed, Developed & Maintained By <a href="https://dhanbad.nic.in" target="blank">National Informatics Centre, Dhanbad</a></span>
            <p class="text-info"><small>Version 2.3.0</small></p>
        </div>
    </div>
</footer>
</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>



<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>


<!-- Table export as PDF,Excel,Json,SQL,Word,CSV,PNG -->
<script src="plugins/tableExport/libs/js-xlsx/xlsx.core.min.js"></script>
<script src="plugins/tableExport/libs/FileSaver/FileSaver.min.js"></script>
<script src="plugins/tableExport/libs/jsPDF/jspdf.min.js"></script>
<script src="plugins/tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script type="text/javascript" src="plugins/tableExport/libs/es6-promise/es6-promise.auto.min.js"></script>
<script src="plugins/tableExport/libs/html2canvas/html2canvas.min.js"></script>
<script src="plugins/tableExport/tableExport.js"></script>
<!-- END Scripts -->

<script type="text/javascript">
    function exportTableAs(tableClass, exportType,filename) {
        $("table." + tableClass).tableExport({
            type: exportType,
			fileName: filename,
			jspdf: {orientation: 'l',
					format: 'a3',
					margins: {right: 10, left: 10, top: 40, bottom: 40},
					autotable: {tableWidth: 'auto'}
					}
			
        });
    }	
</script>
<script>
    $('#myModal').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>

<script>
    // This Sectin For Print Content 
    document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));    
    window.print();
    }

    function printElement(elem) {
        var $printSection = document.getElementById("printSection");
        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }
        $printSection.innerHTML = "";
    }      
</script>
</body>
</html>