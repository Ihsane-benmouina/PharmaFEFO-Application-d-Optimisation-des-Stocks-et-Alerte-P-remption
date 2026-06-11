
<?php
/** @var array $usersList */
/** @var string|null $error */
/** @var string|null $success */
?>
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 pb-4 gap-2">
        <div>
            <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2 tracking-tight">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.65-3.886m-3.21 3.521a10.5 10.5 0 0 0-7.422 0m0 0A10.511 10.511 0 0 1 12 13.25c2.256 0 4.352.708 6.074 1.913M11.25 10.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18.75 8a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                Gestion des Comptes & Équipe
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Espace Administrateur — Configuration des accès restrictifs et rôles applicatifs</p>
        </div>
        <div class="bg-emerald-500/10 text-emerald-800 border border-emerald-500/10 px-2.5 py-1 rounded-xl text-[11px] font-bold flex items-center gap-1.5 shadow-xs uppercase tracking-wide shrink-0">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Mode Admin Strict
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-xs border border-slate-100 lg:col-span-1 h-fit lg:sticky lg:top-6">
            <div class="mb-5">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    Ajouter un Collaborateur
                </h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Créez un compte sécurisé pour l'équipe</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="mb-4 p-3.5 bg-rose-50 border border-rose-200 text-rose-900 text-xs font-semibold rounded-xl flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-rose-500 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold rounded-xl flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-500 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=users" class="space-y-4">
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Nom :</label>
                        <input type="text" name="nom" placeholder="Nom" 
                               class="w-full p-3 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-slate-50/50 transition-all font-medium text-slate-800" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Prénom :</label>
                        <input type="text" name="prenom" placeholder="Prénom" 
                               class="w-full p-3 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-slate-50/50 transition-all font-medium text-slate-800" required>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Email Professionnel :</label>
                    <input type="email" name="email" placeholder="Ex: sara@pharma.com" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-slate-50/50 transition-all font-mono text-slate-800" required>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Mot de passe provisoire :</label>
                    <input type="password" name="password" placeholder="••••••••" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-slate-50/50 transition-all text-slate-800" required>
                    <span class="text-[10px] text-slate-400 font-medium block mt-1.5">Le mot de passe sera automatiquement crypté via PASSWORD_BCRYPT.</span>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Rôle & Droits d'accès :</label>
                    <select name="role" class="w-full p-3 border border-slate-200 rounded-xl text-xs bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all" required>
                        <option value="pharmacien">💊 Pharmacien Titulaire (Droits US 2.1, 3.1, 4.1)</option>
                        <option value="preparateur">🩺 Préparateur en Pharmacie (Droits US 1.1, 3.1)</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-3.5 px-4 rounded-xl shadow-xs hover:shadow-md transition-all uppercase tracking-wider mt-2">
                    Créer l'accès sécurisé
                </button>
            </form>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-xs border border-slate-100 lg:col-span-2">
            <div class="mb-5">
                <h3 class="text-sm font-bold text-slate-800">Utilisateurs enregistrés</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Visualisation des comptes actifs disposant d'un rôle d'authentification</p>
            </div>

            <div class="overflow-x-auto rounded-xl border border-slate-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                            <th class="p-4">Membre de l'Équipe</th>
                            <th class="p-4">Identifiant / Email</th>
                            <th class="p-4 text-center">Niveau de Privilèges</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        <?php foreach ($usersList as $u): ?>
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors font-medium text-slate-700">
                                <td class="p-4 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 font-bold text-xs flex items-center justify-center uppercase border border-emerald-100/50 shrink-0">
                                        <?= mb_substr($u['prenom'], 0, 1) . mb_substr($u['nom'], 0, 1) ?>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 tracking-tight"><?= htmlspecialchars($u['nom'] . ' ' . $u['prenom']) ?></div>
                                        <div class="text-[10px] text-slate-400 font-medium">ID Système : #<?= $u['id'] ?></div>
                                    </div>
                                </td>
                                
                                <td class="p-4 font-mono text-[11px] text-slate-500">
                                    <?= htmlspecialchars($u['email']) ?>
                                </td>
                                
                                <td class="p-4 text-center whitespace-nowrap">
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span class="px-2 py-0.5 bg-rose-50 text-rose-700 border border-rose-100 rounded-md text-[10px] font-bold uppercase tracking-wide inline-block">
                                             Super Admin
                                        </span>
                                    <?php elseif ($u['role'] === 'pharmacien'): ?>
                                        <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-100 rounded-md text-[10px] font-bold uppercase tracking-wide inline-block">
                                             Pharmacien
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-md text-[10px] font-bold uppercase tracking-wide inline-block">
                                             Préparateur
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

