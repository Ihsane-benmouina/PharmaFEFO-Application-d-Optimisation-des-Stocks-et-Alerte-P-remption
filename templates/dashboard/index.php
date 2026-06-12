<?php
/** @var array $processedLots */
/** @var array $notifications */
/** @var string|null $filter */
?>
<div class="space-y-6 text-slate-700 font-sans">
    
    <!-- Top Minimalist Healthcare Header -->
    <div class="bg-white p-6 rounded-xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2">
                <div class="w-2 h-4 bg-slate-400 rounded-xs"></div>
                <h2 class="text-lg font-bold text-slate-800 tracking-tight">
                    Surveillance Globale des Lots
                </h2>
            </div>
            <p class="text-xs text-slate-400 mt-0.5">
                Visibilité analytique et traçabilité réglementaire ordonnées selon la méthode stricte <span class="font-semibold text-slate-600">Premier Périmé, Premier Sorti (FEFO)</span>.
            </p>
        </div>

        <!-- System Controls Filters -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto text-xs">
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <a href="index.php?action=users" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg font-semibold transition-all flex items-center gap-1.5 shadow-xs uppercase tracking-wider">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Ajouter Collaborateur
                </a>
            <?php endif; ?>

            <a href="index.php?action=dashboard" class="px-3.5 py-2 rounded-lg font-medium border transition-all <?= !$filter ? 'bg-slate-100 text-slate-800 border-slate-300/80 font-bold' : 'text-slate-500 border-slate-200 hover:bg-slate-50' ?>">
                Tous les lots
            </a>
            
            <a href="index.php?action=dashboard&filter=ROUGE" class="px-3.5 py-2 rounded-lg font-medium border transition-all <?= $filter === 'ROUGE' ? 'bg-rose-50 text-rose-700 border-rose-200 shadow-xs' : 'text-rose-600 border-rose-100 hover:bg-rose-50/50' ?>">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-600 inline-block animate-pulse <?= $filter === 'ROUGE' ? 'bg-white' : '' ?>"></span> Alerte Critique (<30j)
            </a>
        </div>
    </div>

    <!-- Alert Corridor Block -->
    <?php if (!empty($notifications)): ?>
        <div class="bg-amber-50/40 border border-amber-200 rounded-xl p-5 relative overflow-hidden">
            <div class="flex items-center gap-1.5 font-bold text-amber-800 text-[11px] tracking-wide uppercase mb-3.5">
                <svg class="w-3.5 h-3.5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                COULOIR D'ALERTE FEFO (PÉREMPTION PRÉVUE LE MOIS PROCHAIN)
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <?php foreach ($notifications as $notif): ?>
                    <div class="bg-white border border-amber-100 p-3 rounded-lg flex justify-between items-center shadow-xs group">
                        <div class="space-y-0.5 max-w-[65%]">
                            <span class="font-semibold text-xs text-slate-700 block truncate"><?= htmlspecialchars($notif['produit_nom']) ?></span>
                            <span class="inline-block text-[10px] text-slate-400 font-mono">Lot: <?= htmlspecialchars($notif['numero_lot']) ?></span>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="font-mono font-bold text-amber-700 text-xs block"><?= $notif['date_peremption'] ?></span>
                            <span class="text-[9px] text-amber-800 bg-amber-100/60 px-1.5 py-0.5 rounded-full font-semibold uppercase mt-1 inline-block">Alerte Proche</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Stock Grid Component -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        
        <!-- Table Control Info subheader -->
        <div class="p-4 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-1.5 h-3 bg-slate-400 rounded-xs"></span> Etat Virtuel d Stock Actif
            </div>
            <span class="text-xs text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200 font-medium">
                Total : <span class="font-bold text-slate-800"><?= count($processedLots) ?></span> lot(s) filtré(s)
            </span>
        </div>

        <!-- Clean Clinical Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap text-xs">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-slate-400 font-semibold tracking-wide uppercase">
                        <th class="py-3 px-5">Désignation Produit</th>
                        <th class="py-3 px-4">Référence</th>
                        <th class="py-3 px-4">N° de Lot</th>
                        <th class="py-3 px-4">Quantité Physique</th>
                        <th class="py-3 px-4">DLU (Péremption)</th>
                        <th class="py-3 px-4">Indicateur Diagnostic</th>
                        <?php if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['pharmacien', 'admin'])): ?>
                            <th class="py-3 px-5 text-right">Actions Restrictives</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-600">
                    <?php if (empty($processedLots)): ?>
                        <tr>
                            <td colspan="7" class="py-12 px-5 text-center text-slate-400 font-medium">
                                <p class="text-sm font-bold text-slate-800">Aucun lot actif disponible</p>
                                <p class="text-xs text-slate-400 mt-0.5">Aucun lot ne correspond aux critères de tri actuels.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($processedLots as $l): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors duration-100">
                                <td class="py-3.5 px-5">
                                    <span class="font-bold text-slate-800 block"><?= htmlspecialchars($l['produit_nom']) ?></span>
                                    <span class="text-[10px] text-slate-400 mt-0.5 block">Stock ID: #<?= $l['id'] ?></span>
                                </td>
                                
                                <td class="py-3.5 px-4 font-mono text-slate-400">
                                    <?= htmlspecialchars($l['reference']) ?>
                                </td>
                                
                                <td class="py-3.5 px-4 font-mono font-semibold text-slate-600">
                                    <span class="bg-slate-100/60 px-2 py-0.5 rounded border border-slate-200/40"><?= htmlspecialchars($l['numero_lot']) ?></span>
                                </td>
                                
                                <td class="py-3.5 px-4">
                                    <span class="font-bold text-slate-800 text-sm"><?= $l['quantite'] ?></span> 
                                    <span class="text-[10px] text-slate-400 ml-0.5">unités</span>
                                </td>
                                
                                <td class="py-3.5 px-4 font-mono text-slate-700">
                                    <?= $l['date_peremption'] ?>
                                </td>
                                
                                <td class="py-3.5 px-4">
                                    <?php if((isset($l['statut']) && $l['statut'] === 'EXPIRED') || (isset($l['badge_text']) && strpos($l['badge_text'], 'EXPIRED') !== false)): ?>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                             Périmé (Expired)
                                        </span>
                                    <?php elseif(strpos($l['badge_text'], 'Rouge') !== false): ?>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                             Critique (&lt;30j)
                                        </span>
                                    <?php elseif(strpos($l['badge_text'], 'Orange') !== false): ?>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                             Vigilance (&lt;90j)
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                             Conforme (&gt;6m)
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <?php if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['pharmacien', 'admin'])): ?>
                                    <td class="py-3.5 px-5 text-right">
                                        <?php 
                                        $isLotExpired = (isset($l['statut']) && $l['statut'] === 'EXPIRED') || (isset($l['badge_text']) && strpos($l['badge_text'], 'EXPIRED') !== false);
                                        
                                        if ($isLotExpired): ?>
                                            <form method="POST" action="index.php?action=retirer-petime" class="inline">
                                                <input type="hidden" name="lot_id" value="<?= $l['id'] ?>">
                                                <button type="submit" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir retirer ce lot périmé ? La valeur financière du gâchis sera calculée et ajoutée au rapport.')"
                                                        class="inline-flex items-center gap-1 bg-white hover:bg-rose-50 border border-slate-200 hover:border-rose-200 text-rose-600 font-bold text-[10px] uppercase tracking-wider px-2.5 py-1.5 rounded-lg transition-colors cursor-pointer shadow-xs active:scale-95">
                                                     Retirer & Valider la perte
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-[11px] text-slate-400 font-semibold italic select-none">
                                                 Sécurisé (En Stock)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>