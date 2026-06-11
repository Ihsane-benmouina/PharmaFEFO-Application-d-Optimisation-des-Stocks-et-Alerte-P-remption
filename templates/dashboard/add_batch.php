<?php
/** @var array $products Zid had l-khit bch intelephense yfhamha direct */
?>
<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
...

<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-black text-gray-950 flex items-center gap-2">
            Réception & Entrées intelligentes
        </h2>
        <p class="text-xs text-gray-500 mt-1">Rôle : Préparateur en pharmacie — Saisie des numéros de lot et DLU</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-600 rounded text-red-900 text-sm font-bold flex items-center gap-2">
            <span></span> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="mb-4 p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded text-emerald-900 text-sm font-bold flex items-center gap-2">
            <span></span> <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=add-batch" class="space-y-5">
        
        <div>
            <label class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-1.5">Médicament Réceptionné :</label>
            <select name="produit_id" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <option value="">-- Choisir un produit de la base --</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= htmlspecialchars($p['nom']) ?> (Ref: <?= htmlspecialchars($p['reference']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-1.5">Numéro de Lot (Batch Number) :</label>
            <input type="text" name="numero_lot" placeholder="Ex: LOT-2026-AUGM" class="w-full p-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-1.5">Quantité (Unités boîtes) :</label>
            <input type="number" name="quantite" min="1" placeholder="Ex: 100" class="w-full p-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-1.5">Date de Péremption (DLU) :</label>
            <input type="date" name="date_peremption" class="w-full p-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <span class="text-[11px] text-gray-400 mt-1 block">Le système validera uniquement si la date est supérieure ou égale à aujourd'hui.</span>
        </div>

        <button type="submit" class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-bold text-sm p-3.5 rounded-lg shadow transition-all uppercase tracking-wider mt-2">
            Enregistrer et Classer f l-FEFO
        </button>

    </form>
</div>