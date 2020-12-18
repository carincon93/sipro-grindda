<template>
    <div>
        <div class="form-group">
            <label class="text-md-left">Cantidad de objetivos específicos</label>
            <p class="small">
                Seleccione la cantidad de objetivos específicos
            </p>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="numeroObjetivosEspecificos" id="objetivos3" value="3" v-model.number="qty">
                    <label class="form-check-label" for="objetivos3">3 objetivos específicos</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="numeroObjetivosEspecificos" id="objetivos4" value="4" v-model.number="qty">
                    <label class="form-check-label" for="objetivos4">4 objetivos específicos</label>
                </div>
            </div>
        </div>

        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['objetivoEspecifico.'+index]}" v-for="(n, index) in qty">
            <label class="text-md-left" :for="'objetivoEspecifico'+index">Objetivo específico Nro. {{ index + 1}}</label>
            <textarea :id="'objetivoEspecifico'+index" name="objetivoEspecifico[]" class="form-control" rows="4" cols="80" required></textarea>
            <span v-if="errors['objetivoEspecifico.'+index]" class="invalid-feedback">
                <strong>{{ errors['objetivoEspecifico.'+index][0] }}</strong>
            </span>
        </div>
        </div>
    </div>

</template>

<script type="text/javascript">
export default {
    props: ['errors'],
    data: function () {
        return {
            qty: 4,

            checkedCantidadObjetivos: 0,
        }
    }
}
</script>
