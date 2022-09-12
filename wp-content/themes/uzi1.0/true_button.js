(function() {
    tinymce.PluginManager.add('true_mce_button', function( editor, url ) { // id кнопки true_mce_button должен быть везде один и тот же
        editor.addButton( 'true_mce_button', { // id кнопки true_mce_button
            icon: 'grunion', // мой собственный CSS класс, благодаря которому я задам иконку кнопки
            type: 'menubutton',
            title: 'Заголовок', // всплывающая подсказка при наведении
            menu: [ // тут начинается первый выпадающий список
                { // второй элемент первого выпадающего списка, просто вставляет [misha]
                    text: 'Заголовок',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Задайте параметры поля',
                            body: [
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'multilineName',
                                    label: 'Текст блока',
                                    value: '',
                                    multiline: true, // большое текстовое поле - textarea
                                    minWidth: 300, // минимальная ширина в пикселях
                                    minHeight: 100 // минимальная высота в пикселях
                                },
                            ],
                            onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
                                editor.insertContent( '[heading text="' + e.data.multilineName + '"]');
                            }
                        });
                    }
                }
            ]
        });
    });
    tinymce.PluginManager.add('true_mce_button2', function( editor, url ) { // id кнопки true_mce_button должен быть везде один и тот же
        editor.addButton( 'true_mce_button2', { // id кнопки true_mce_button
            icon: 'grunion', // мой собственный CSS класс, благодаря которому я задам иконку кнопки
            type: 'menubutton',
            title: 'Изображение с текстом', // всплывающая подсказка при наведении
            menu: [ // тут начинается первый выпадающий список
                { // второй элемент первого выпадающего списка, просто вставляет [misha]
                    text: 'Изображение с текстом',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Задайте параметры поля',
                            body: [
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'img',
                                    label: 'Ссылка на картинку',
                                    value: '',
                                },
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'text',
                                    label: 'Текст на картинке',
                                    value: '',
                                    multiline: true, // большое текстовое поле - textarea
                                    minWidth: 300, // минимальная ширина в пикселях
                                    minHeight: 100 // минимальная высота в пикселях
                                },
                            ],
                            onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
                                editor.insertContent( '[textwithimage  imgurl="' + e.data.img + '" imgtext="' + e.data.text + '"]');
                            }
                        });
                    }
                }
            ]
        });
    });
    tinymce.PluginManager.add('true_mce_button3', function( editor, url ) { // id кнопки true_mce_button должен быть везде один и тот же
        editor.addButton( 'true_mce_button3', { // id кнопки true_mce_button
            icon: 'grunion', // мой собственный CSS класс, благодаря которому я задам иконку кнопки
            type: 'menubutton',
            title: 'Рейтинг продукта', // всплывающая подсказка при наведении
            menu: [ // тут начинается первый выпадающий список
                { // второй элемент первого выпадающего списка, просто вставляет [misha]
                    text: 'Рейтинг продукта',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Задайте параметры поля',
                            body: [
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'product_id',
                                    label: 'ID продукта',
                                    value: '',
                                }
                            ],
                            onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
                                editor.insertContent( '[productrating  id="' + e.data.product_id + '" place="' + e.data.text + '"]');
                            }
                        });
                    }
                }
            ]
        });
    });
    tinymce.PluginManager.add('true_mce_button4', function( editor, url ) { // id кнопки true_mce_button должен быть везде один и тот же
        editor.addButton( 'true_mce_button4', { // id кнопки true_mce_button
            icon: 'grunion', // мой собственный CSS класс, благодаря которому я задам иконку кнопки
            type: 'menubutton',
            title: 'После рейтинга продукта', // всплывающая подсказка при наведении
            menu: [ // тут начинается первый выпадающий список
                { // второй элемент первого выпадающего списка, просто вставляет [misha]
                    text: 'Описание под продуктом',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Задайте параметры поля',
                            body: [
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'description',
                                    label: 'Описание',
                                    value: '',
                                    multiline: true, // большое текстовое поле - textarea
                                    minWidth: 300, // минимальная ширина в пикселях
                                    minHeight: 100 // минимальная высота в пикселях
                                },
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'ref',
                                    label: 'Важное',
                                    value: '',
                                    multiline: true, // большое текстовое поле - textarea
                                    minWidth: 300, // минимальная ширина в пикселях
                                    minHeight: 100 // минимальная высота в пикселях
                                },
                                {
                                    type: 'textbox', // тип textbox = текстовое поле
                                    name: 'important',
                                    label: 'Справка',
                                    value: '',
                                    multiline: true, // большое текстовое поле - textarea
                                    minWidth: 300, // минимальная ширина в пикселях
                                    minHeight: 100 // минимальная высота в пикселях
                                },
                            ],
                            onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
                                editor.insertContent( '[producttext  description="' + e.data.description + '" important="' + e.data.important + '" ref="' + e.data.ref + '"]');
                            }
                        });
                    }
                }
            ]
        });
    });
})();