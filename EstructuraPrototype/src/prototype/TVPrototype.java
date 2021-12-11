package prototype;

import java.util.HashMap;

public class TVPrototype {
    private final HashMap<String, TV> prototipos = new HashMap<>();

    public TVPrototype() {
        // ? Esto ya es no es un molde, si no un prototipo y apartir de aquí clonamos
        Plasma plasma = new Plasma("Sony", 50, "Plateado", 10000, 60.85, 0.001);
        prototipos.put("plasma", plasma);
        LCD lcd = new LCD("Panasonic", 21, "Azul", 1000, 6552.0);
        prototipos.put("lcd", lcd);

    }

    // ? Realiza la clonación
    public Object prototipo(String tipo) throws CloneNotSupportedException {
        return prototipos.get(tipo).clone();
    }
}
