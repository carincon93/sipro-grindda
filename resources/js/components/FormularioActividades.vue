<template>
    <div>
        <div>
            <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['fechaInicio']}">
                <label :for="objects.fechaInicioId">Fecha inicio</label>
                <input :id="objects.fechaInicioId" type="date" name="fechaInicio" class="form-control" v-model="objects.fechaInicio" @change="moment(objects)" required>
                <span v-if="errors['fechaInicio']" class="invalid-feedback d-block">
                    <strong>{{ errors['fechaInicio'][0] }}</strong>
                </span>
            </div>
            <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['fechaFin']}">
                <label :for="objects.fechaFinId">Fecha fin</label>
                <input :id="objects.fechaFinId" type="date" name="fechaFin" class="form-control" v-model="objects.fechaFin" @change="moment(objects)" required>
                <span v-if="errors['fechaFin']" class="invalid-feedback d-block">
                    <strong>{{ errors['fechaFin'][0] }}</strong>
                </span>
            </div>
            <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['duracion']}">
                <label>Duración (días)</label>
                <input type="number" name="duracion" class="form-control" min="0" max="99999" readonly v-bind:value="objects.diferenciaDias">
                <span v-if="errors['duracion']" class="invalid-feedback d-block">
                    <strong>{{ errors['duracion'][0] }}</strong>
                </span>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
import business from 'moment-business';
export default {
    props: ['errors'],
    data: function () {
        return {
            objects: [
                {id: 1, fechaInicio: '', fechaFin: '', diferenciaDias: '', fechaInicioId: 'fechaInicioC1', fechaFinId: 'fechaFinC1'},
                // {id: 2, fechaInicio: '', fechaFin: '', diferenciaDias: '', descripcionId: 'descripcionC2', fechaInicioId: 'fechaInicioC2', fechaFinId: 'fechaFinC2'},
                // {id: 3, fechaInicio: '', fechaFin: '', diferenciaDias: '', descripcionId: 'descripcionC3', fechaInicioId: 'fechaInicioC3', fechaFinId: 'fechaFinC3'},
                // {id: 4, fechaInicio: '', fechaFin: '', diferenciaDias: '', descripcionId: 'descripcionC4', fechaInicioId: 'fechaInicioC4', fechaFinId: 'fechaFinC4'},
            ],
        }
    },
    methods: {
        moment: function (element) {
            var self = this;
            var fecha1 = moment(element.fechaInicio, 'YYYY/MM/DD');
            var fecha2 = moment(element.fechaFin, 'YYYY/MM/DD');

            self.objects.diferenciaDias = business.weekDays( fecha1, fecha2 );
        },
    },
}
</script>
