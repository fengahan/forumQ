<div class="content__inner">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <header class="content__title">
                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">表单布局</font></font></h1>
                <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">由于引导应用</font></font><code>display: block</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">和</font></font><code>width: 100%</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">几乎所有的表单控件，表格会默认堆栈垂直。</font><font style="vertical-align: inherit;">可以使用其他类来根据表单更改此布局。</font></font></small>

                <div class="actions">
                    <a href="" class="actions__item zmdi zmdi-trending-up"></a>
                    <a href="" class="actions__item zmdi zmdi-check-all"></a>

                    <div class="dropdown actions__item">
                        <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item">Refresh</a>
                            <a href="" class="dropdown-item">Manage Widgets</a>
                            <a href="" class="dropdown-item">Settings</a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">水平形式</font></font></h4>
                    <h6 class="card-subtitle"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">通过利用网格类，使用网格创建水平表单。</font><font style="vertical-align: inherit;">请务必同时添加，</font></font><code class="highlighter-rouge">.col-form-label</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">以</font></font><code class="highlighter-rouge">&lt;label&gt;</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">使它们与相关的表单控件垂直居中。</font></font></h6>

                    <form>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="电子邮件地址">
                                    <i class="form-group__bar"></i>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">密码</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="密码">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">无线电</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="radio">
                                        <input type="radio" name="form-horizontal-radio" id="form-horizontal-radio-1">
                                        <label class="radio__label" for="form-horizontal-radio-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">第一电台</font></font></label>
                                    </div>

                                    <div class="radio">
                                        <input type="radio" name="form-horizontal-radio" id="form-horizontal-radio-2">
                                        <label class="radio__label" for="form-horizontal-radio-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">第一电台</font></font></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">复选框</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input type="checkbox" name="form-horizontal-radio-1" id="form-horizontal-checkbox-1">
                                        <label class="checkbox__label" for="form-horizontal-checkbox-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">示例复选框</font></font></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">示例按钮</font></font></button>
                    </form>

                    <br>
                    <br>

                    <h3 class="card-body__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">水平表单标签大小</font></font></h3>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">一定要使用</font></font><code>.col-form-label-sm</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">或</font></font><code>.col-form-label-lg</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">您的</font></font><code>&lt;label&gt;</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">S或</font></font><code>&lt;legend&gt;</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">s到正确遵循的大小</font></font><code>.form-control-lg</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">和</font></font><code>.form-control-sm</code><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>

                    <br>

                    <form>
                        <div class="row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="格式标签">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label col-form-label-lg"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="col-form-label-lg">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>