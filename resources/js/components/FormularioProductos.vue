<template>
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
            <label>Duración (meses)</label>
            <input type="text" name="duracion" class="form-control" v-bind:value="objects.diferenciaMeses" readonly required>
            <span v-if="errors['duracion']" class="invalid-feedback d-block">
                <strong>{{ errors['duracion'][0] }}</strong>
            </span>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
    props: ['errors', 'datos'],
    data: function () {
        return {
            objects: [
                {id: 1, fechaInicio: '', fechaFin: '', diferenciaMeses: '', fechaInicioId: 'fechaInicioP1', fechaFinId: 'fechaFinP1'},
            ],
        }
    },
    methods: {
        moment: function (element) {
            var self = this;

            var fecha1 = moment(element.fechaInicio, 'YYYY/MM/DD');
            var fecha2 = moment(element.fechaFin, 'YYYY/MM/DD');

            self.objects.diferenciaMeses = isNaN(fecha2.diff(fecha1, 'months')) ? 'calculando...' : fecha2.diff(fecha1, 'months');
        }
    },
}
</script>
