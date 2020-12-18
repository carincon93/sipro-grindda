<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="form-group form-group-custom" v-bind:class="{'is-invalid' : recomendaciones.itemAEvaluar == 'titulo'}">
                    <label class="col-form-label text-md-left" for="tituloProyecto">Título del proyecto</label>
                    <div>
                        <p>
                            {{ proyecto.titulo }}
                        </p>
                    </div>
                </div>
                <div class="form-group form-group-custom" v-bind:class="{'is-invalid' : recomendaciones.itemAEvaluar == 'antecedentesJustificacionProyecto'}">
                    <label class="col-form-label text-md-left" for="tituloProyecto">Antecedentes y justificacion del proyecto</label>
                    <div>
                        <p>
                            {{ recomendaciones.recomendacion }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['proyecto', 'proyectoid'],
        data: function () {
            return {
                recomendaciones: [],
            }
        },
        mounted() {
            console.log('Component mounted.')

            var self = this;
            axios.get('/panel/proyectos/'+this.proyectoid+'/obtener_recomendaciones/')
            .then(function(response) {
                console.log(response);
                self.recomendaciones = response.data[0]
            });
        }
    }
</script>
