<?php
/** @var array $notifications */
?>
<div class="max-w-xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl text-slate-100">
    
    <div class="mb-6 pb-4 border-b border-slate-800">
        <h2 class="text-base font-bold text-white tracking-tight uppercase flex items-center gap-2">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
            </span>
            Flux de Veille d'Anticipation
        </h2>
        <p class="text-xs text-slate-400 mt-1 font-medium">Lots dont l'expiration (DLU) intervient au cours du cycle mensuel suivant :</p>
    </div>

    <?php if (empty($notifications)): ?>
        <div class="p-6 bg-slate-950 border border-slate-800 rounded-2xl text-center">
            <p class="text-xs font-medium text-emerald-400 font-mono">✓ STATUS_OK: Aucun élément critique détecté pour le mois prochain.</p>
        </div>
    <?php else: ?>
        <div class="relative pl-4 border-l border-slate-800 space-y-5">
            <?php foreach ($notifications as $n): ?>
                <div class="relative group">
                    <div class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-slate-900 border-2 border-orange-500 group-hover:bg-orange-500 transition-colors"></div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 bg-slate-950/60 border border-slate-800/60 rounded-xl hover:border-slate-700 transition-all">
                        <div>
                            <span class="text-xs font-bold text-slate-200 tracking-tight block"><?= htmlspecialchars($n['produit_nom']) ?></span>
                            <div class="text-[10px] text-slate-500 font-mono mt-0.5">Lot ref: <?= htmlspecialchars($n['numero_lot']) ?></div>
                        </div>
                        <div class="text-left sm:text-right font-mono text-[11px] shrink-0">
                            <span class="text-orange-400 font-bold"><?= $n['date_peremption'] ?></span>
                            <div class="text-[9px] text-slate-500 font-sans mt-0.5">Vol stock: <?= $n['quantite'] ?> units</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-8 pt-4 border-t border-slate-800 flex justify-start">
        <a href="index.php?action=dashboard" class="text-[11px] font-mono text-slate-400 hover:text-emerald-400 transition-colors flex items-center gap-1">
            <span>&lt;!--</span> Retour Dashboard <span>--&gt;</span>
        </a>
    </div>
</div>