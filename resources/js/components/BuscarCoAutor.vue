<template>
    <div>
        <div class="row">

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="number" pattern="[0-9]" class="form-control" placeholder="Introduce el número de documento" v-model="busqueda" v-on:change="obtenerCoAutores">
                    <div class="input-group-append">
                        <button type="button" class="btn input-group-text input-group-busqueda" v-on:click="mostrarPanel"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="lista-coautores" v-bind:class="{active: isActive}">
            <h3 class="text-center">Co-autores</h3>
            <img :src="assetImg+'images/coautor.png'" alt="" class="rounded-circle d-block mx-auto" width="100">
            <p class="text-center mt-2"><i v-show="loading" class="fa fa-spinner fa-spin fa-3x"></i></p>
            <button type="button" class="btn btn-sm btn-primary btn-ocultar" v-on:click="ocultarPanel"><i class="fas fa-angle-right"></i></button>
            <ul class="list-group" v-if="filtrarCoAutores.length">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-if="coautor['id'] !== userid" v-for="coautor in filtrarCoAutores">
                    {{ coautor.nombre }}
                    <button type="button" class="btn btn-success btn-sm" v-on:click="agregarNuevoCoAutor(coautor)">Agregar</button>
                </li>
            </ul>
            <p v-else>El usuario con este número de documento no se encuentra</p>
        </div>
        <div>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(seleccionado, index) in coautoresSeleccionados">
                    <img :src="assetImg+'storage/'+seleccionado.foto" alt="" class="rounded-circle" width="40">
                    <p class="m-0 ml-4">{{ seleccionado.nombre }}</p>
                    <input type="hidden" class="form-control" name="nombreAutor[]" v-bind:value="seleccionado.id">
                    <button type="button" class="btn-action btn-action-danger" v-on:click.prevent="removeElement(index)"><i class="fas fa-times"></i></button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(data, index) in coautoresbd">
                    <img :src="assetImg+'storage/'+data['foto']" alt="" class="rounded-circle" width="40">
                    <p class="text-center m-0 ml-4">{{ data['nombre'] }}</p>
                    <div v-if="data['numeroDocumento'] == documento">
                        <span class="badge badge-primary">Autor</span>
                    </div>
                    <input type="hidden" class="form-control" name="nombreAutor[]" v-bind:value="data['id']">
                    <button type="button" class="btn-action btn-action-danger" v-if="userid !== data['id']" v-on:click.prevent="remove(index)"><i class="fas fa-times"></i></button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['coautoresguardados', 'userid', 'userdocumento'],
        data: function () {
            return {
                assetImg: asset,
                busqueda: '',
                isActive: false,
                coautores: [],
                coautoresSeleccionados: [],
                coautoresbd: this.coautoresguardados,
                documento: this.userdocumento,
                loading: false
            }
        },
        methods: {
            obtenerCoAutores () {
                var self = this;
                self.loading = true;
                if (self.busqueda !== '') {
                    axios.get('/panel/obtener_coautores').then(function(response) {
                        self.coautores = response.data;
                        self.isActive = true;
                        self.loading = false;
                    })
                } else {
                    self.coautores = [];
                    self.isActive = false;
                }
            },
            agregarNuevoCoAutor: function (coautor) {
                this.coautoresSeleccionados.push({
                    id: coautor.id,
                    nombre: coautor.nombre,
                    foto: coautor.foto
                })
            },
            mostrarPanel: function () {
                this.isActive = true
            },
            ocultarPanel: function () {
                this.isActive = false
            },
            removeElement: function(index) {
                this.coautoresSeleccionados.splice(index, 1);
            },
            remove: function(index) {
                this.coautoresbd.splice(index, 1);
            },
        },
        computed: {
            filtrarCoAutores: function () {
                var self = this;
                return this.coautores.filter( function (coautor) {
                    if (coautor.numeroDocumento.toString().indexOf(self.documento)) {
                        return coautor.numeroDocumento.toString().indexOf(self.busqueda) >= 0
                    }
                })
            }
        }

    }
</script>
