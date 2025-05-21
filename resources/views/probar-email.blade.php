<form method="POST" action="/enviar-codigo">
    @csrf
    <input type="email" name="email" placeholder="Tu correo">
    <button type="submit">Enviar código</button>
</form>
