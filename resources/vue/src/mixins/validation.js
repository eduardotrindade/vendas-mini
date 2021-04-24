export default {
  methods: {
    /**
     * Adds custom error messages to the component
     * @param errors
     */
    setValidationErrors(errors) {
      if (!errors) return;

      for (let field in errors) {
        this.errorMessages[field] = errors[field][0];
      }

      this.$refs.$validator.setErrors(errors);
    }
  }
}
