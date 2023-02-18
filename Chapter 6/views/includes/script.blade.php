<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
<script src="{{ asset('assets/js/init/weather-init.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script src="{{ asset('assets/js/init/fullcalendar-init.js') }}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>

<script>
    ClassicEditor
            .create( document.querySelector( '.ckeditor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.log( error );
            } );
</script>

<script>
    jQuery(document).ready(function($){
        $('#mymodal').on('show.bs.modal', function(e){
            var button = $(e.relatedTarget);
            var modal = $(this);
            modal.find('.modal-body').load(button.data("remote"));
            modal.find('.modal-title').html(button.data("title"));
        });
    });
</script>

<div class="modal" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.table thead th[data-sort]').click(function() {
            var th = $(this),
                thIndex = th.index(),
                inverse = false;

            $('.table tbody tr').sort(function(tr1, tr2) {
                var td1 = $(tr1).find('td').eq(thIndex).text(),
                    td2 = $(tr2).find('td').eq(thIndex).text();

                if (th.data('sort') === 'price') {
                    td1 = parseFloat(td1.replace(/Rp\. /g, '').replace(/,/g, ''));
                    td2 = parseFloat(td2.replace(/Rp\. /g, '').replace(/,/g, ''));
                } else if (th.data('sort') === 'quantity') {
                    td1 = parseInt(td1);
                    td2 = parseInt(td2);
                }

                if (td1 < td2) return inverse ? 1 : -1;
                if (td1 > td2) return inverse ? -1 : 1;
                return 0;
            }).appendTo('.table tbody');
        });
    });
</script>

<script>
   document.querySelector('#sort_by').addEventListener('change', function() {
  const sortBy = this.value;
  const rows = [...document.querySelectorAll('.searchable tr')];

  rows.sort((a, b) => {
    const aData = a.querySelector(`[data-sort="${sortBy}"]`);
    const bData = b.querySelector(`[data-sort="${sortBy}"]`);

    if (!aData || !bData) {
      return 0;
    }

    const aValue = aData.textContent;
    const bValue = bData.textContent;

    if (sortBy === 'price') {
      return parseInt(aValue.replace(/[^\d]/g, '')) - parseInt(bValue.replace(/[^\d]/g, ''));
    } else if (sortBy === 'quantity') {
      return parseInt(aValue) - parseInt(bValue);
    } else {
      return aValue.localeCompare(bValue);
    }
  });

  const searchable = document.querySelector('.searchable');
  while (searchable.firstChild) {
    searchable.removeChild(searchable.firstChild);
  }
  searchable.append(...rows);
});
</script>






