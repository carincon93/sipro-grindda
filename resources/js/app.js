require('./bootstrap');

import dt from 'datatables.net-bs4';

window.moment = require('moment');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('agregar-personal', require('./components/FormularioRecursosHumanos.vue').default);
Vue.component('aliados', require('./components/FormularioAliados.vue').default);
Vue.component('posconflicto', require('./components/FormularioPosconflicto.vue').default);
Vue.component('objetivos', require('./components/FormularioObjetivos.vue').default);
Vue.component('notificaciones', require('./components/Notificaciones.vue').default);
Vue.component('productos', require('./components/FormularioProductos.vue').default);
Vue.component('productos-editar', require('./components/FormularioProductosEditar.vue').default);
Vue.component('actividades', require('./components/FormularioActividades.vue').default);
Vue.component('actividades-editar', require('./components/FormularioActividadesEditar.vue').default);
// CREAR PRESUPUESTOS
Vue.component('presupuesto', require('./components/presupuesto/Presupuesto.vue').default);

Vue.component('corregir-proyecto', require('./components/CorreccionProyecto.vue').default);

Vue.component('buscar-coautor', require('./components/BuscarCoAutor.vue').default);

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            selectedTipoContrasena: '',
            loading: false,
            tipoProyecto: null,
            objetivoEspecifico4: false,
        }
    },
    methods: {
        actualizarObjetivoEspecifico: function (e) {
            var self = this;
            var element = e.currentTarget;
            var valorObjetivoEspecifico = element.value;
            var idObjetivoEspecifico    = element.getAttribute('data-objetivoespecificoid');
            var idProyecto              = element.getAttribute('data-proyectoid');

            axios.post('/panel/proyectos/objetivo_especifico/editar' , {objetivoEspecifico: valorObjetivoEspecifico, idObjetivoEspecifico: idObjetivoEspecifico}).then(function(response) {
                if (response.data == 'guardado') {
                    document.getElementById('especifico'+idObjetivoEspecifico).innerHTML = '<i class="d-inline-block fa fa-check mr-2" style="background: #57e443;padding:  4px;border-radius:  50%;color:  #ffff;font-size:  9px;"></i>Guardado'
                }
            })
        },
        guardarEvaluacionAjax: function (e) {
            let formData    = new FormData(event.target);
            var id          = event.target.getAttribute('data-id');
            var item        = event.target.getAttribute('data-item');
            var self        = this;

            self.loading = true;
            axios.post(e.target.action, formData).then(function(response) {
                console.log(response);
                self.loading = false;
                document.getElementById('cargando').style.display = "none";
                if (response.data == 'guardado') {
                    document.getElementById(item+id).classList.add('btn-success');
                    document.getElementById(item+id).innerHTML = 'Guardado';
                }
            })
        },
    }
});

jQuery(document).ready(function($){

    $('.fecha').each(function (index, dateElem) {
        var $dateElem = $(dateElem);
        var formatted = moment($dateElem.text()).locale('es').format('LL');
        $dateElem.text(formatted);
    });

    $('[data-toggle="tooltip"]').tooltip();

    // Eliminar(CRUD)
    $('[data-toggle="popover"]').popover();

    $('.dropdown-submenu button.btn-transparent').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

    $( '#app' ).delegate( '*', 'focus blur', function() {
        var elem = $( this );
        elem.parent().toggleClass( 'focused', elem.is( ':focus' ) );
    });

    $('body').on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var $formDel        = $(this),
        $nombre_elemento    = $formDel.attr('data-tipo');
        $mensaje            = $formDel.attr('data-mensaje');

        $('.modal').find('.modal-title').text($nombre_elemento);
        $('.modal').find('.mensaje-confirmacion').text('Está seguro que desea eliminar este registro?');
        $('.modal').find('.mensaje').text($mensaje);
        $('#btn-delete').text('Eliminar');
        $('#confirm-delete').modal({ backdrop: 'static', keyboard: false }).on('click', '#btn-delete', function () {
            $formDel.submit();
        });
    });

    $('.dataTable').DataTable({
        "ordering": false,
        "sDom": '<"row view-filter"<"col-md-6"l><"col-md-6"f>>t<"row view-pager"<"col-sm-12"ip>>',
        "info": false,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-chevron-left'></i>",
                "next": "<i class='fas fa-chevron-right'></i>",
            },
            "search": "",
            "sSearchPlaceholder": "Buscar:",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "sInfo": "Mostrando <strong>_START_ a _END_</strong> de _TOTAL_ registros",
            "emptyTable": "No hay datos disponibles en la tabla",
            "sEmptyTable": "No hay datos disponibles en la tabla",
            "infoFiltered": " - filtrando de _MAX_ registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No hay registros para mostrar",
            "sInfoEmpty": "Mostrando <strong>0 a 0</strong> de 0 registros",

        }
    });

    $('form').not('.form-destroy').on('submit', function(){
        $('.loading').css('display', 'flex ');
        $(this).submit(function() {
            return false;
        });
        return true;
    });

    // Suma de criterios
    $('select[name="puntajeAsignadoItem[]"]').change(function(){
        var suma = 0;
        var puntajeMaximo = $('input[name="criterioPuntajeMaximo"]').val();
        $('select[name="puntajeAsignadoItem[]"] :selected').each(function() {
            suma += Number($(this).val());
        });
        $("#suma").html('Puntaje máximo: ' + puntajeMaximo + ' | Total: ' + suma);
        if (suma > puntajeMaximo) {
            $('#guardarEvaluacionCriterio').attr('disabled', 'true');
        } else {
            $('#guardarEvaluacionCriterio').removeAttr('disabled', 'true');
        }
    });

    // $('input[type="radio"]').on('click', function (e) {
    //     var input = this;
    //
    //     // $(form).find('.form-group').empty();
    //
    //     // Iterate over all checkboxes in the table
    //     $('input[type="radio"]').each(function () {
    //         // If checkbox is checked
    //         if (this.checked) {
    //             // Create a hidden element
    //            $('form').find('div.oculto').append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
    //         }
    //     });
    // });


	//check if a .cd-tour-wrapper exists in the DOM - if yes, initialize it

	$('.cd-tour-wrapper').exists() && initTour();

	function initTour() {
		var tourWrapper  = $('.cd-tour-wrapper'),
			tourSteps    = tourWrapper.children('li'),
			stepsNumber  = tourSteps.length,
			coverLayer   = $('.cd-cover-layer'),
			tourStepInfo = $('.cd-more-info'),
			tourTrigger  = $('#cd-tour-trigger');

		//create the navigation for each step of the tour
		createNavigation(tourSteps, stepsNumber);
		if(!tourWrapper.hasClass('active') && cookie != 'tutorial') {
			//in that case, the tour has not been started yet
			tourWrapper.addClass('active');
			showStep(tourSteps.eq(0), coverLayer);
		}


		tourTrigger.on('click', function(){
			//start tour
			if(!tourWrapper.hasClass('active')) {
				//in that case, the tour has not been started yet
				tourWrapper.addClass('active');
				showStep(tourSteps.eq(0), coverLayer);
			}
		});

		//change visible step
		tourStepInfo.on('click', '.cd-prev', function(event){
			//go to prev step - if available
			( !$(event.target).hasClass('inactive') ) && changeStep(tourSteps, coverLayer, 'prev');
		});
		tourStepInfo.on('click', '.cd-next', function(event){
			//go to next step - if available
			( !$(event.target).hasClass('inactive') ) && changeStep(tourSteps, coverLayer, 'next');
		});

		//close tour
		tourStepInfo.on('click', '.cd-close', function(event){
			closeTour(tourSteps, tourWrapper, coverLayer);
		});

		//detect swipe event on mobile - change visible step
		tourStepInfo.on('swiperight', function(event){
			//go to prev step - if available
			if( !$(this).find('.cd-prev').hasClass('inactive') && viewportSize() == 'mobile' ) changeStep(tourSteps, coverLayer, 'prev');
		});
		tourStepInfo.on('swipeleft', function(event){
			//go to next step - if available
			if( !$(this).find('.cd-next').hasClass('inactive') && viewportSize() == 'mobile' ) changeStep(tourSteps, coverLayer, 'next');
		});

		//keyboard navigation
		$(document).keyup(function(event){
			if( event.which=='37' && !tourSteps.filter('.is-selected').find('.cd-prev').hasClass('inactive') ) {
				changeStep(tourSteps, coverLayer, 'prev');
			} else if( event.which=='39' && !tourSteps.filter('.is-selected').find('.cd-next').hasClass('inactive') ) {
				changeStep(tourSteps, coverLayer, 'next');
			} else if( event.which=='27' ) {
				closeTour(tourSteps, tourWrapper, coverLayer);
			}
		});
	}

	function createNavigation(steps, n) {
		var tourNavigationHtml = '<div class="cd-nav"><span><b class="cd-actual-step">1</b> de '+n+'</span><ul class="cd-tour-nav"><li><a href="#0" class="cd-prev">&#171; Atrás</a></li><li><a href="#0" class="cd-next">Siguiente &#187;</a></li></ul></div><a href="#0" class="cd-close">Close</a>';

		steps.each(function(index){
			var step = $(this),
				stepNumber = index + 1,
				nextClass = ( stepNumber < n ) ? '' : 'inactive',
				prevClass = ( stepNumber == 1 ) ? 'inactive' : '';
			var nav = $(tourNavigationHtml).find('.cd-next').addClass(nextClass).end().find('.cd-prev').addClass(prevClass).end().find('.cd-actual-step').html(stepNumber).end().appendTo(step.children('.cd-more-info'));
		});
	}

	function showStep(step, layer) {
		step.addClass('is-selected').removeClass('move-left');
		smoothScroll(step.children('.cd-more-info'));
		showLayer(layer);
	}

	function smoothScroll(element) {
		(element.offset().top < $(window).scrollTop()) && $('body,html').animate({'scrollTop': element.offset().top}, 100);
		(element.offset().top + element.height() > $(window).scrollTop() + $(window).height() ) && $('body,html').animate({'scrollTop': element.offset().top + element.height() - $(window).height()}, 100);
	}

	function showLayer(layer) {
		layer.addClass('is-visible').on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
			layer.removeClass('is-visible');
		});
	}

	function changeStep(steps, layer, bool) {
		var visibleStep = steps.filter('.is-selected'),
			delay = (viewportSize() == 'desktop') ? 300: 0;
		visibleStep.removeClass('is-selected');

		(bool == 'next') && visibleStep.addClass('move-left');

		setTimeout(function(){
			( bool == 'next' )
				? showStep(visibleStep.next(), layer)
				: showStep(visibleStep.prev(), layer);
		}, delay);
	}

	function closeTour(steps, wrapper, layer) {
		steps.removeClass('is-selected move-left');
		wrapper.removeClass('active');
		layer.removeClass('is-visible');
	}

	function viewportSize() {
		/* retrieve the content value of .cd-main::before to check the actua mq */
		return window.getComputedStyle(document.querySelector('.cd-tour-wrapper'), '::before').getPropertyValue('content').replace(/"/g, "").replace(/'/g, "");
	}
});

//check if an element exists in the DOM
jQuery.fn.exists = function(){ return this.length > 0; }