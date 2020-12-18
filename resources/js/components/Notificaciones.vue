<template>
    <li class="nav-item dropdown" @click="obtenerNotificaciones">
        <a id="navbarDropdownNotification" v-bind:class="'nav-link dropdown-toggle '+unread" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="cantidad-notificaciones" v-bind:class="[notificaciones.length > 0 ? 'pulse-button' : '']">{{ notificaciones.length }}</span>
            <i class="far fa-bell"></i>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="navbarDropdownNotification">
            <div v-if="notificaciones.length && userrol == 5">
                <div v-for="notificacion in notificaciones" :key="notificacion.id">
                    <div v-if="notificacion.data.tipoNotificacion == 'caja-ideas'">
                        <a class="dropdown-item d-flex p-0" v-bind:href="url+'/caja_ideas/'+notificacion.data.id" @click="marcarComoLeido (notificacion.id)">
                            <div class="flex-1 notificacion-proyecto-nuevo">
                                {{ notificacion.data.nombreEmpresa }}
                                <p class="small mensaje-evaluacion">¡{{ notificacion.data.nombreEmpresa }} ha generado una idea de proyecto!</p>
                            </div>
                            <div class="notificacion-hora-formulacion">
                                <p class="small">{{ setHora(notificacion.data.creado) }}</p>
                            </div>
                        </a>
                    </div>
                    <div v-if="notificacion.data.tipoNotificacion == 'proyecto-enviado'">
                        <a class="dropdown-item d-flex p-0" v-bind:href="url+'/evaluacion/'+notificacion.data.id+'/evaluacion_informacion_principal'" @click="marcarComoLeido (notificacion.id)">
                            <div class="flex-1 notificacion-proyecto-nuevo">
                                {{ notificacion.data.titulo }}
                                <p class="small mensaje-evaluacion">¡{{ notificacion.data.nombreAutorNotificacion }} ha enviado a evaluación un proyecto!</p>
                            </div>
                            <div class="notificacion-hora-formulacion">
                                <p class="small">{{ setHora(notificacion.data.creado) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div v-else-if="notificaciones.length && userrol == 1">
                <div v-for="notificacion in notificaciones" :key="notificacion.id">
                    <a class="dropdown-item d-flex p-0" v-bind:href="url+'/proyectos/'+notificacion.data.id" @click="marcarComoLeido (notificacion.id)">
                        <div class="flex-1 notificacion-proyecto-nuevo">
                            {{ notificacion.data.titulo }}
                            <p class="small mensaje-evaluacion">¡{{ notificacion.data.nombreAutorNotificacion }} ha evaluado tú proyecto!</p>
                        </div>
                        <div class="notificacion-hora-formulacion">
                            <p class="small">{{ setHora(notificacion.data.creado) }}</p>
                        </div>
                    </a>
                </div>
            </div>
            <span class="dropdown-item" v-else>No tiene notificaciones</span>
        </div>
    </li>
</template>

<script type="text/javascript">
export default {
    props: ['userid', 'userrol'],
    data: function () {
        return {
            notificaciones: [],
            url: url,
            unread: null,
        }
    },
    mounted: function () {
        var self = this;
        axios.get('/panel/obtener_notificaciones/'+this.userid)
        .then(function(response) {
            self.notificaciones = response.data;
            if (self.notificaciones.length) {
                self.unread = 'unread'
            }
        });
    },
    methods: {
        setHora (horaCreacion) {
            var hora = null;
            hora = moment(horaCreacion).format('hh:mm a');
            return hora;
        },
        obtenerNotificaciones () {
            var self = this;
            axios.get('/panel/obtener_notificaciones/'+this.userid)
            .then(function(response) {
                self.notificaciones = response.data;
                if (self.notificaciones.length) {
                    self.unread = 'unread'
                }
            });
        },
        marcarComoLeido (id) {
            var self = this;
            axios.get('/panel/marcar_notificacion/'+id).then();
        }
    }
}
</script>
