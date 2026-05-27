<?php
session_start();
require_once __DIR__ . '/../Functions/auth.php';
proteger('admin');

$adminNome = $_SESSION['user_nome'] ?? 'Admin';
$adminFoto = $_SESSION['user_foto'] ?? '';
$avatarUrl = $adminFoto
    ?: 'https://ui-avatars.com/api/?name=' . urlencode($adminNome) . '&background=06b6d4&color=fff';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel ADM — Focus Study</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/adm.css" />
    <link rel="icon" type="image/png" href="../images/poppy.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="adm-body">

<!-- ════════════════════════════
     SIDEBAR
════════════════════════════ -->
<aside class="adm-sidebar" id="adm-sidebar">

    <div class="sidebar-logo">
        <span class="logo-text">Focus Study</span>
        <span class="logo-badge">Painel ADM</span>
    </div>

    <div class="sidebar-admin">
        <img class="sidebar-admin-avatar"
             src="<?= htmlspecialchars($avatarUrl) ?>"
             alt="Avatar do admin">
        <div class="sidebar-admin-info">
            <div class="sidebar-admin-name"><?= htmlspecialchars($adminNome) ?></div>
            <div class="sidebar-admin-role">Administrador</div>
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="sidebar-nav-label">Principal</div>

        <button class="sidebar-link active" data-section="dashboard">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </button>

        <button class="sidebar-link" data-section="usuarios">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            Usuários
        </button>

        <button class="sidebar-link" data-section="chamados">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
            Chamados
        </button>

        <div class="sidebar-nav-label">Acesso Rápido</div>

        <a href="../inicialusuario.html" class="sidebar-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
            Painel do Usuário
        </a>

        <a href="../suporte-admin.html" class="sidebar-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"/>
            </svg>
            Suporte (legado)
        </a>

        <div class="sidebar-nav-label">Conta</div>

        <a href="../php/logout.php" class="sidebar-link sidebar-link-danger">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
            </svg>
            Sair
        </a>

    </nav>
</aside>

<!-- ════════════════════════════
     ÁREA PRINCIPAL
════════════════════════════ -->
<div class="adm-main">

    <!-- Top bar -->
    <div class="adm-topbar">
        <div>
            <div class="adm-topbar-title" id="adm-topbar-title">Dashboard</div>
            <div class="adm-topbar-sub"   id="adm-topbar-sub">Visão geral do sistema</div>
        </div>
        <div class="adm-topbar-right">
            <span class="adm-topbar-date" id="adm-date"></span>
            <button class="adm-menu-toggle" id="adm-menu-toggle" aria-label="Menu">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="3" y1="6"  x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="adm-content">

        <!-- ══════════════════════════
             SEÇÃO: DASHBOARD
        ══════════════════════════ -->
        <div class="adm-section active" id="section-dashboard">

            <!-- KPIs -->
            <div class="adm-kpi-grid">

                <div class="adm-kpi-card">
                    <div class="adm-kpi-icon kpi-cyan">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="adm-kpi-value" id="kpi-total-users">—</div>
                    <div class="adm-kpi-label">Total de Usuários</div>
                </div>

                <div class="adm-kpi-card">
                    <div class="adm-kpi-icon kpi-green">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="adm-kpi-value" id="kpi-new-today">—</div>
                    <div class="adm-kpi-label">Novos Hoje</div>
                </div>

                <div class="adm-kpi-card">
                    <div class="adm-kpi-icon kpi-yellow">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div class="adm-kpi-value" id="kpi-open-tickets">—</div>
                    <div class="adm-kpi-label">Tickets Abertos</div>
                </div>

                <div class="adm-kpi-card">
                    <div class="adm-kpi-icon kpi-pink">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="adm-kpi-value" id="kpi-total-tickets">—</div>
                    <div class="adm-kpi-label">Total de Tickets</div>
                </div>

            </div>

            <!-- Tabelas rápidas -->
            <div class="adm-dash-grid">

                <!-- Usuários recentes -->
                <div class="adm-card">
                    <div class="adm-card-header">
                        <div class="adm-card-title">Usuários Recentes</div>
                        <button class="adm-btn adm-btn-outline" data-section="usuarios">Ver todos</button>
                    </div>
                    <div class="adm-table-wrap">
                        <table class="adm-table">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Tipo</th>
                                    <th>XP</th>
                                </tr>
                            </thead>
                            <tbody id="recent-users-tbody">
                                <tr><td colspan="3"><div class="adm-loading"><div class="adm-spinner"></div></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Chamados recentes -->
                <div class="adm-card">
                    <div class="adm-card-header">
                        <div class="adm-card-title">Chamados Recentes</div>
                        <button class="adm-btn adm-btn-outline" data-section="chamados">Ver todos</button>
                    </div>
                    <div class="adm-table-wrap">
                        <table class="adm-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Assunto</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody id="recent-tickets-tbody">
                                <tr><td colspan="4"><div class="adm-loading"><div class="adm-spinner"></div></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- ══════════════════════════
             SEÇÃO: USUÁRIOS
        ══════════════════════════ -->
        <div class="adm-section" id="section-usuarios">

            <div class="adm-section-header">
                <div>
                    <div class="adm-section-title">Usuários</div>
                    <div class="adm-section-subtitle">Gerencie todos os usuários da plataforma</div>
                </div>
            </div>

            <div class="adm-search-bar">
                <input class="adm-search-input"
                       id="user-search"
                       type="search"
                       placeholder="Buscar por nome ou e-mail…"
                       autocomplete="off">
            </div>

            <div class="adm-card">
                <div class="adm-card-header">
                    <div class="adm-card-title">Lista de Usuários</div>
                    <span class="adm-card-count" id="usuarios-count">—</span>
                </div>
                <div class="adm-table-wrap">
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>XP</th>
                                <th>Streak</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="usuarios-tbody">
                            <tr><td colspan="7"><div class="adm-loading"><div class="adm-spinner"></div></div></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- ══════════════════════════
             SEÇÃO: CHAMADOS
        ══════════════════════════ -->
        <div class="adm-section" id="section-chamados">

            <div class="adm-section-header">
                <div>
                    <div class="adm-section-title">Chamados de Suporte</div>
                    <div class="adm-section-subtitle">Gerencie os tickets enviados pelos usuários</div>
                </div>
                <div class="adm-tabs">
                    <button class="adm-tab active" data-ticket-filter="all">Todos</button>
                    <button class="adm-tab" data-ticket-filter="open">Abertos</button>
                    <button class="adm-tab" data-ticket-filter="in_progress">Em andamento</button>
                    <button class="adm-tab" data-ticket-filter="resolved">Resolvidos</button>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-header">
                    <div class="adm-card-title">Lista de Chamados</div>
                    <span class="adm-card-count" id="chamados-count">—</span>
                </div>
                <div class="adm-table-wrap">
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Solicitante</th>
                                <th>Assunto</th>
                                <th>Categoria</th>
                                <th>Prioridade</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="chamados-tbody">
                            <tr><td colspan="8"><div class="adm-loading"><div class="adm-spinner"></div></div></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div><!-- /adm-content -->
</div><!-- /adm-main -->

<!-- ════════════════════════════
     MODAL: USUÁRIO
════════════════════════════ -->
<div class="adm-modal-overlay" id="modal-user" onclick="if(event.target===this)closeModal('modal-user')">
    <div class="adm-modal">
        <div class="adm-modal-header">
            <div>
                <div class="adm-modal-id" id="modal-user-id"></div>
                <div class="adm-modal-title" id="modal-user-name"></div>
            </div>
            <button class="adm-modal-close" onclick="closeModal('modal-user')">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="adm-modal-body">
            <div style="text-align:center;margin-bottom:20px">
                <img id="modal-user-avatar" src="" alt=""
                     style="width:72px;height:72px;border-radius:50%;border:3px solid var(--cyan);object-fit:cover">
            </div>
            <div class="adm-modal-row">
                <strong>E-mail</strong>
                <span id="modal-user-email"></span>
            </div>
            <div class="adm-modal-row">
                <strong>XP</strong>
                <span id="modal-user-xp"></span>
            </div>
            <div class="adm-modal-row">
                <strong>Streak</strong>
                <span id="modal-user-streak"></span>
            </div>
            <div class="adm-modal-row">
                <strong>Tipo</strong>
                <span id="modal-user-role"></span>
            </div>
        </div>
    </div>
</div>

<!-- ════════════════════════════
     MODAL: CHAMADO
════════════════════════════ -->
<div class="adm-modal-overlay" id="modal-ticket" onclick="if(event.target===this)closeModal('modal-ticket')">
    <div class="adm-modal">
        <div class="adm-modal-header">
            <div>
                <div class="adm-modal-id" id="modal-ticket-id"></div>
                <div class="adm-modal-title" id="modal-ticket-subject"></div>
            </div>
            <button class="adm-modal-close" onclick="closeModal('modal-ticket')">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="adm-modal-body">
            <div class="adm-modal-row"><strong>Nome</strong><span id="modal-ticket-name"></span></div>
            <div class="adm-modal-row">
                <strong>E-mail</strong>
                <a id="modal-ticket-email" href="#" style="color:var(--cyan)"></a>
            </div>
            <div class="adm-modal-row"><strong>Categoria</strong><span id="modal-ticket-cat"></span></div>
            <div class="adm-modal-row"><strong>Prioridade</strong><span id="modal-ticket-prio"></span></div>
            <div class="adm-modal-row"><strong>Status</strong><span id="modal-ticket-status"></span></div>
            <div class="adm-modal-row"><strong>Data</strong><span id="modal-ticket-date"></span></div>
            <div style="margin-top:16px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text-muted);margin-bottom:8px">
                Mensagem
            </div>
            <div class="adm-modal-message" id="modal-ticket-msg"></div>
        </div>
    </div>
</div>

<!-- Toast -->
<div id="adm-toast"></div>

<script src="../js/adm.js"></script>
</body>
</html>
